<template>
	<div>
		<div v-if="success" class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="Close">×</button>
			{{ success }}
		</div>
		<div v-if="numberErrors > 0" class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="Close">×</button>
			<template v-if="numberErrors == 1">Есть ошибка формы.</template>
			<template v-else>Есть ошибки формы.</template>
		</div>
	</div>
</template>

<script>

    export default {

        computed: {

            success() {
                return this.$page.props.flash.success;
            },

            numberErrors() {
                return Object.keys(this.$page.props.errors).length;
			}
        }
    }
</script>
