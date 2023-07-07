<template>
	<div>
		<Head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
		</Head>


		<div class="admin-layout hold-transition sidebar-mini layout-fixed">
			<div class="wrapper">

<!--				&lt;!&ndash; Preloader &ndash;&gt;-->
<!--				<div class="preloader flex-column justify-content-center align-items-center">-->
<!--					<img class="animation__shake" src="/Admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
<!--				</div>-->

				<!-- Main Sidebar Container -->
				<aside class="main-sidebar sidebar-dark-primary elevation-4">
					<!-- Brand Logo -->
					<a href="index3.html" class="brand-link">
						<img src="/images/AdminSidebar/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
						<span class="brand-text font-weight-light">Админ-панель</span>
					</a>

					<!-- Sidebar -->
					<div class="sidebar">
						<!-- Sidebar user panel (optional) -->
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
							<div class="image">
								<img src="/images/AdminSidebar/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
							</div>
							<div class="info">
								<a href="#" class="d-block">{{ $page.props.auth.user.name }}</a>
							</div>
						</div>

						<!-- Sidebar Menu -->
						<nav class="sidebar-menu mt-2">
							<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

								<li
									v-for="(navLink, index) in navLinks" :key="index"
									:class="[{'menu-open': active && navLink.innerNavLinks}, 'nav-item']">

									<nav-link :nav-link="navLink"></nav-link>

									<ul v-if="navLink.innerNavLinks" class="nav nav-treeview">

										<li v-for="(navLink, index) in navLink.innerNavLinks" :key="index" class="nav-item">
											<nav-link @active="active=$event" :nav-link="navLink"></nav-link>
										</li>

									</ul>

								</li>

								<li class="nav-item">
									<a @click.prevent="form.post(route('logout.store'))" href="#" class="nav-link">
										<i class="nav-icon fas fa-align-left"></i>
										Log Out
									</a>
								</li>

							</ul>
						</nav>

					</div>
					<!-- /.sidebar -->
				</aside>

				<!-- Content Wrapper. Contains page content -->
				<slot></slot>
				<!-- /.content-wrapper -->

				<!-- Control Sidebar -->
				<aside class="control-sidebar control-sidebar-dark">
					<!-- Control sidebar content goes here -->
				</aside>
				<!-- /.control-sidebar -->
			</div>
			<!-- ./wrapper -->

		</div>
	</div>
</template>


<script>

    require('admin-lte')
    require('~/admin-lte/plugins/select2/js/select2.full.min.js');
    require('@/Plugins/fontawesome.js');

	import NavLink from "@/Components/NavLink";
    import {Head} from "@inertiajs/inertia-vue3";

    export default {

        components: {
			NavLink,
            Head
		},

		data() {
            return {

                navLinks: [
                    {
                        name: 'Главная',
                        url: this.route('dashboard'),
                        leftIcon: 'nav-icon fas fa-tachometer-alt'
                    },
                    {
                        name: 'Продукты',
                        leftIcon: 'nav-icon fas fa-align-left',
                        rightIcon: 'right fas fa-angle-left',
                        innerNavLinks: [
                            {
                                name: 'Все продукты',
                                url: this.route('dashboard.products'),
                            },
                            {
                                name: 'Добавить продукт',
                                url: this.route('dashboard.products.create'),
                            }
                        ]
                    }
                ],
                active: false,
                form: this.$inertia.form(),
			}
		},
    }
</script>



<style lang="scss">

	@import "~admin-lte/plugins/select2/css/select2.min";
    @import "~admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min";
	@import "~admin-lte/build/scss/adminlte";
	@import "resources/sass/Plugins/reset";


	.admin-layout {


		.wrapper {
			height: 100vh !important;
		}

		.log-out-button {
			color: #c2c7d0;
			text-align: left;
		}

		.log-out-button:hover {
			background-color: rgba(255, 255, 255, 0.1);
			color: #fff !important;
		}

		.nav-link i {
			color: #c2c7d0;
		}

		.main-sidebar {
			position: fixed !important;
		}
	}


</style>
