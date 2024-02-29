@props([
	'id',
	'title' => ''
])

<div 
	id="{{ $id }}"
	aria-hidden="true" 
	class="popup popup_sm" 
	:class="show && 'popup_show'"
	@popup.window="open"
	x-data="{
		show: false,
		title: '{{ $title }}',

		open(event) {
			console.log(event.detail, this.$root.id)
			if (event.detail !== this.$root.id) return

			this.show = true
		}
	}"
>
	<div class="popup__wrapper">
		<div class="popup__content">
			<button data-close type="button" class="popup__close _icon-close" @click="show = false"></button>
			<div class="popup__text">
				<div class="popup__inner">
					<div class="popup__title" x-text="title"></div>
					{{ $slot }}
				</div>
			</div>
		</div>
	</div>
</div>
