<template>
	<admin-layout>

		<Head>
			<title> Редактировать продукт </title>
		</Head>

		<div class="edit-product content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"></h1>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<form @submit.prevent="submitEditProduct" class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-primary">
								<div class="card-body">
									<validation-errors></validation-errors>
									<div class="form-group">
										<label for="exampleInputname">Имя</label>
										<input type="text" v-model="form.name" class="form-control" id="exampleInputname" placeholder="Введите имя продукта">
										<div class="errors" v-if="form.errors.name">{{ form.errors.name }}</div>
									</div>
									<div class="form-group">
										<label>Описание</label>
										<textarea v-model="form.description" class="form-control" rows="5" placeholder="Введите описание продукта"></textarea>
										<div class="errors" v-if="form.errors.description">{{ form.errors.description }}</div>
									</div>
									<div class="form-group">
										<label>Категории</label>
										<select id="selectCategories" multiple="multiple" class="custom-select categories" style="width: 100%;">
											<option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
										</select>
										<div class="errors" v-if="form.errors.category_ids">{{ form.errors.category_ids }}</div>
									</div>
									<div class="form-group">
										<text-input class="text-input" type="number"
													v-model="form.price" :label="{ text: 'Цена' }" :input="{ class: 'price' }"
													:error="form.errors.price" step="0.01" />
									</div>
									<div class="form-group">
										<p class="labels">Метки</p>
										<checkbox-input v-for="(label, i) in labels" :key="label.id"
														:value="label.id" v-model="form.label_ids"
														:label="{ name: this.labels[i].name, nameLocation: 'right'}"
										/>
										<array-errors class="array-errors" array-name="label_ids" :errors="form.errors" />
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary">Обновить</button>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="card card-primary">
								<div class="card-body">
									<div class="form-group">

										<label>Изображение</label>

										<img :src="imageSrc" class="img-fluid image-preview" @click="clickInput" alt="">

										<input ref="uploadImage" class="d-none" type="file" accept="image/*" @change="fileInputChange">

										<div class="errors" v-if="form.errors.image">{{ form.errors.image }}</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!-- /.content -->
		</div>

	</admin-layout>
</template>

<script>
    import AdminLayout from "@/Layouts/AdminLayout.vue";
    import ValidationErrors from "@/Components/ValidationErrors.vue";
    import CheckboxInput from '@/Components/Checkbox.vue';
    import ArrayErrors from "@/Components/ArrayErrors.vue";
    import TextInput from "@/Components/Input.vue";
    import { Head } from '@inertiajs/vue3';

    export default {

        components: {
            ValidationErrors,
			AdminLayout,
			CheckboxInput,
			ArrayErrors,
			TextInput,
            Head
        },

		props: {
            categories: Array,
            flash: Object,
			product: Object,
            labels: Array,
		},

		data() {
            return {
				form: this.$inertia.form({
					_method: 'PATCH',
					id: this.product.id,
					name: this.product.name,
					description: this.product.description,
					category_ids: this.product.category_ids,
                    label_ids: this.product.label_ids,
					price: this.product.price,
					image: null
				}),
                imageSrc: this.product.image,
			}
		},


        mounted() {

            this.selectCategories();
        },

		computed: {

            selectClass() {

                return $('.edit-product .categories');
			}
		},

		methods: {

            clickInput() {
                this.$refs.uploadImage.click();
            },

            fileInputChange(event) {

                this.form.image = event.target.files[0];

                const reader = new FileReader();

                reader.onload = e => {

                    this.imageSrc = e.target.result;
                };

                reader.readAsDataURL(this.form.image);
            },

            submitEditProduct() {
                this.form.post(route('dashboard.products.product.update', this.product.id));
			},

            selectCategories() {

                this.selectClass.select2();

                this.selectClass.val(this.product.category_ids).trigger('change');


                this.selectClass.on('select2:select', (e) => {

                    this.form.category_ids.push(e.params.data.id);
                });

                this.selectClass.on('select2:unselect', (e) => {

                    let index = this.form.category_ids.indexOf(e.params.data.id);

                    this.form.category_ids.splice(index, 1);
                });
			}
		}

    }
</script>

<style lang="scss">


	.edit-product {

		.image-preview {
			display: flex;
			align-items: center;
			justify-content: center;
			border: 1px dashed green;
			cursor: pointer;
			height: 365px;
		}

		img.image-preview {
			border: none;
		}

		.price {
			width: auto;
		}

		.labels {
			font-weight: 700;
			margin-bottom: .5rem;
		}

		.errors {
			margin-top: .25rem;
			font-size: .875em;
			color: #dc3545;
		}

	}

</style>
