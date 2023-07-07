<template>
	<admin-layout>

		<Head>
			<title> Products </title>
		</Head>

		<div class="all-products content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<messages></messages>
							<h1 class="m-0">Все продукты</h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card">
						<div class="card-body p-0">
							<table class="table table-striped projects">
								<thead>
									<tr>
										<th>
											Id
										</th>
										<th style="width: 15%">
											Название
										</th>
										<th>
											Цена
										</th>
										<th>
											Категории
										</th>
										<th style="width: 10%">
											Изображение
										</th>
										<th>
										</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="product in products.data" :key="product.id">
										<td>
											{{ product.id }}
										</td>
										<td>
											{{ product.name }}
										</td>
										<td>
											{{ product.price }}
										</td>
										<td>
											<template v-for="category in product.categories" :key="category.id">
												{{ category.name }} <br>
											</template>
										</td>
										<td>
											<img class="img-size" :src="product.image">
										</td>
										<td class="project-actions text-right">
											<Link class="btn btn-info btn-sm" :href="route('dashboard.products.product.edit', product.id)">
												<i class="fas fa-pencil-alt">
												</i>
												Редактировать
											</Link>
											<a class="btn btn-danger btn-sm" @click.prevent="productRemovalForm.post(route('dashboard.products.product.destroy', product.id))" href="#">
												<i class="fas fa-trash">
												</i>
												Удалить
											</a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<pagination class="pagination" :products="products"></pagination>
				</div>
			</div>
		</div>
	</admin-layout>
</template>

<script>

    import AdminLayout from "@/Layouts/AdminLayout";
    import Pagination from "@/Components/Pagination";
    import Messages from "@/Components/Messages";
    import { Head, Link } from '@inertiajs/inertia-vue3';


    export default {


		data() {
            return {
                productRemovalForm: this.$inertia.form({
					_method: 'delete'
				})
			}
		},

        components: {
            Messages,
			Pagination,
			AdminLayout,
            Head,
            Link
        },

		props: {
            products: [Array, Object]
		},

    }
</script>

<style lang="scss">

	.all-products {

		.project-actions a+a {
			margin-left: 5px;
		}

		.img-size {
			width: 100px;
			height: 100px;
		}

		.pagination {
			margin-top: 1.5rem;
		}
	}

</style>
