<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix">
        	{{ Form::text('translatable[storefront_copyright_text]', trans('storefront::attributes.storefront_copyright_text'), $errors, $settings) }}
			{{ Form::textarea('marquee_text', 'Add Marquee Text', $errors, $settings) }}
			{{ Form::wysiwyg('footer_desc', 'Footer Description', $errors, $settings, ['required' => false]) }}
		</div>

        <div class="box-content clearfix">
        	@include('media::admin.image_picker.single', [
        	    'title' => trans('storefront::storefront.form.accepted_payment_methods_image'),
        	    'inputName' => 'storefront_accepted_payment_methods_image',
        	    'file' => $acceptedPaymentMethodsImage,
        	])

			@include('media::admin.image_picker.single', [
				'title' => trans('Membership Image 1'),
				'inputName' => 'storefront_footer_membership_image_one',
				'file' => $footerMembershipImageOne,
			])

			@include('media::admin.image_picker.single', [
				'title' => trans('Membership Image 2'),
				'inputName' => 'storefront_footer_membership_image_two',
				'file' => $footerMembershipImageTwo,
			])

			@include('media::admin.image_picker.single', [
				'title' => trans('Corporate Client'),
				'inputName' => 'storefront_footer_corporate_client',
				'file' => $footerCorporateClient,
			])


        </div>
    </div>
</div>

