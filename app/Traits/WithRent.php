<?php

namespace App\Traits;

use App\Models\Movie;
use App\Services\Rental\MovieTag\MovieTag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


trait WithRent
{
    /**
     * @var array<string, array<int, MovieTag>>
     */
    protected array $movieTags = [];

    /**
     * @param array<int, array<string, string|int>>|array<string, string|int> $movies
     * @return void
     */
    public function addRent(array $movies): void
    {
        DB::transaction(function () use($movies)
        {
            $movieRentRecords = $this->prepareMovieRentRecords($movies);

            DB::table('movie_rent')->insert($movieRentRecords);
        });
    }

    public function showRentStatement(): string
    {
        $this->setMovieTagsFromService(); /** @see \App\Services\Rental\MovieTag\MovieTag */

        $movieRentRecords = $this->getMovieRentRecords();

        $statement = "Учет аренды для " . $this->name . "\n\n";

        foreach ($movieRentRecords as $movieRentRecord)
        {
            $statement .=
                "{$movieRentRecord->name}: {$movieRentRecord->days} дн. x {$movieRentRecord->count} кол. = {$movieRentRecord->cost} грн" . "\n";
        }

        $statement .= "\n" . "Сумма задолженности составляет: " . $this->getRentTotalCost() . " грн" . "\n";
        $statement .= "Ваш бонус за активность: " . $this->getRentTotalPoints();

        return $statement;
    }

    /**
     * @param array<int, array<string, string|int>>|array<string, string|int> $movies
     * @return array
     */
    private function prepareMovieRentRecords(array $movies): array
    {
        if(isset($movies['name']))
            $movies = [$movies];

        $movieCollection = collect($movies);

        if(!$this->rent) {

            $rent = $this->rent()->create();

            $this->setRelation('rent', $rent);
        }

        $movieIds = Movie::whereIn('name', $movieCollection->pluck('name'))
            ->pluck('id', 'name');

        $movieRentRecords = $movieCollection->map(function ($item) use ($movieIds) {
            return [
                'instance_id' => (string) Str::uuid(),
                'rent_id' => $this->rent->id,
                'movie_id' => $movieIds[$item['name']],
                'days' => $item['days'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        });

        return $movieRentRecords->all();
    }

    /**
     * @see \App\Services\Rental\MovieTag\MovieTag
     *
     * @return void
     */
    private function setMovieTagsFromService(): void
    {
        if(!count($this->movieTags))
        {
            $this->rent->load('movies.tags');

            $classNames = MovieTag::getClassNames();

            foreach ($this->rent->movies->unique() as $movie) {
                foreach ($movie->tags as $tag) {

                    foreach ($classNames as $className) {

                        if($tag->name === $className::getTagName())
                        {
                            $this->movieTags[$movie->name][] = new $className();
                        }
                    }
                }
            }
        }
    }

    private function getMovieCost(string $movieName, int $days): float
    {
        $cost = 0.0;

        foreach ($this->movieTags[$movieName] as $movieTag)
        {
            $cost += $movieTag->getCost($days);
        }

        return $cost;
    }

    private function getRentTotalCost(): float
    {
        $totalCost = 0.0;

        foreach($this->rent->movies as $movie)
        {
            $totalCost += $this->getMovieCost($movie->name, $movie->pivot->days);
        }

        return $totalCost;
    }

    private function getMoviePoints(string $movieName, int $days): int
    {
        $points = 0;

        foreach ($this->movieTags[$movieName] as $movieTag)
        {
            $points += $movieTag->getPoints($days);
        }

        return $points;
    }

    private function getRentTotalPoints(): int
    {
        $totalPoints = 0;

        foreach($this->rent->movies as $movie)
        {
            $totalPoints += $this->getMoviePoints($movie->name, $movie->pivot->days);
        }

        return $totalPoints;
    }

    /**
     * @return Collection<int, \stdClass>
     */
    private function getMovieRentRecords(): Collection
    {
        $movieRentRecords = DB::table('movie_rent')
            ->select('name', 'days', DB::raw('count(*) as count'))
            ->join('movies', 'movie_rent.movie_id', '=', 'movies.id')
            ->where('rent_id', $this->rent->id)
            ->groupBy('movie_id', 'days')
            ->orderBy('movie_id')
            ->orderBy('count', 'desc')
            ->get();

        // Adding a cost field to the $movieRentRecords
        foreach ($movieRentRecords as $movieRentRecord)
        {
            $movieRentRecord->cost =
                $this->getMovieCost($movieRentRecord->name, $movieRentRecord->days) * $movieRentRecord->count;
        }

        return $movieRentRecords;
    }
}
