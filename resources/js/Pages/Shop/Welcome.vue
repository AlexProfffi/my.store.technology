<template>
	<div>
		<Head>
			<title> Главная </title>
		</Head>

		<div class="container">
            <template v-for="category in categories" :key="category.id">
                <h3 class="pb-2">{{ category.name }}</h3>
                <div class="row">
                    <product-card :category="category"/>
                </div>
            </template>
		</div>
	</div>
</template>


<script>

import ShopLayout from "@/Layouts/ShopLayout";

export default {
    layout: ShopLayout
}

</script>


<script setup>

// ======== Import ========

import ProductCard from '@/Components/ProductCard';



// let str = `...<a style="ff" class='wrong'>... <p style="" class="doc">...<a
// href="link1" class="wrong">`
// let results = str.matchAll(/<(([^\s]+)\s*(([\w-]*)\s*=\s*['"]([^'"]*)['"]))[^>]*>/g);
//
// for (let result of results) {
//     console.log(result)
// }
//console.log(t1, t2)


// let dateRegexp = /(?<year>\d{4})-(?<month>\d{2})-(?<day>\d{2})/g;
// let dateStrings = "2019-04-30 2021-12-08";
// let dates = dateStrings.matchAll(dateRegexp);
//
// for (let date of dates) {
//     let {year, month, day} = date.groups;
//
//     console.log(date)
// }


// let str = "2019-04-30, 2021-12-08";
// let regexp = /(?<year>\d{4})-(?<month>\d{2})-(?<day>\d{2})/g;
// str = str.replace(regexp, '$<day>-$<month>-$<year>')
// console.log(str);


// let regexp = /^([A-F0-9]{2}:){5}[A-F0-9]{2}$/;
//
// console.log( regexp.test('01:32:54:67:89:AB') ); // true
//
// console.log( regexp.test('0132546789AB') ); // false (нет двоеточий)
//
// console.log( regexp.test('01:32:54:67:89') ); // false (5 чисел, должно быть 6)
//
// console.log( regexp.test('01:32:54:67:89:ZZ') ) // false (ZZ в конце строки)


// let regexp = /#([A-F0-9]{3}){1,2}([;\s]|$)/gi;
//
// let str = "color: #3f3; background-color: #AA00ef; and: #abcd";
//
// let results = str.match(regexp);
//
// results = results.map((result) =>
//     result.replace(/[;\s]/, '')
// )
// console.log(results); // #3f3 #AA00ef


// let regexp = /(#(?:[A-F0-9]{3}){1,2})(?:[;\s]|$)/gi;
//
// let str = "color: #3f3; background-color: #AA00ef; and: #abcd";
//
// let results = str.matchAll(regexp);
//
// let rgbs = [];
//
// for (let result of results) {
//     rgbs = [...rgbs, result[1]]
// }
// console.log(rgbs)


// let regexp = /#([A-F0-9]{3}){1,2}\b/gi;
//
// let str = "color: #3f3; background-color: #AA00ef; and: #abcd";
//
// console.log(str.match(regexp));
// НЕ ЗАБЫТЬ ПОРАБОТАТЬ С РУССКИМ ЯЗЫКОМ
// глянуть кое-что 9 ююня


// ======== Props ========

const props = defineProps({
    categories: Object,
})

</script>


<style scoped lang="scss">

    .products {
        margin-bottom: 1.5rem;
    }

</style>
