<template>
	<div>
		<div v-if="isFlashMessages" :class="['alert alert-success alert-dismissible', flashMessage.style]" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true" aria-label="Close">×</button>
			{{ flashMessage.description }}
		</div>
	</div>
</template>

<script>

    export default {

        computed: {

            flashMessage() {

                return {
                    'noRights': {
                        style: 'alert-danger',
                        description: this.flashMessages['noRights'],
                    },
                    'message419': {
                        style: 'alert-danger',
                        description: this.flashMessages['message419'],
                    },
                    'deleteProduct': {
                        style: 'alert-danger',
                        description: this.flashMessages['deleteProduct'],
                    },
                    'updateProduct': {
                        style: 'alert-success',
                        description: this.flashMessages['updateProduct'],
                    },

                }[Object.keys(this.flashMessages)[0]];
            },

            flashMessages() {
                return this.$page.props.flash;
            },

			isFlashMessages() {
                return Object.keys(this.flashMessages).length;
			},
        }
    }
</script>
