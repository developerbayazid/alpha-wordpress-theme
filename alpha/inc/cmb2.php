<?php

function cmb2_add_image_information_metabox() {

    $prefix = '_alpha_';

    $cmb = new_cmb2_box( array(
        'id'           => $prefix . 'image_information',
        'title'        => __( 'Image Information', 'alpha' ),
        'object_types' => array( 'post' ),
        'context'      => 'normal',
        'priority'     => 'default',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Camera Model', 'alpha' ),
        'id'   => $prefix . 'camera_model',
        'type' => 'text',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Location', 'alpha' ),
        'id'   => $prefix . 'location',
        'type' => 'text',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Date', 'alpha' ),
        'id'   => $prefix . 'date',
        'type' => 'text_date',
    ) );

    $cmb->add_field( array(
        'name' => __( 'Licensed?', 'alpha' ),
        'id'   => $prefix . 'licensed_',
        'type' => 'checkbox',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'License Information', 'alpha' ),
        'id'         => $prefix . 'license_information',
        'type'       => 'textarea',
        'attributes' => array(
            'required' => true, // Will be required only if visible.
            'data-conditional-id' => $prefix . 'licensed_',
        ),
    ) );

    $cmb->add_field( array(
        'name' => __( 'Image', 'alpha' ),
        'id'   => $prefix . 'image',
        'type' => 'file',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Upload Resume', 'alpha' ),
        'id'         => $prefix . 'resume',
        'type'       => 'file',
        'text'       => array(
            'add_upload_file_text' => 'Upload PDF',
        ),
        'options'    => array(
            'url' => false,
        ),
        'query_args' => array(
            'type' => 'application/pdf',
        ),
    ) );

}
add_action( 'cmb2_init', 'cmb2_add_image_information_metabox' );

// Pricing Table
function cmb2_pricing_table_metabox() {
	$prefix = '_alpha_';

	$cmb = new_cmb2_box( array(
        'id'           => $prefix . 'pricing_table',
        'title'        => __( 'Pricing Table', 'alpha' ),
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'default',
    ) );

	$group_field_id = $cmb->add_field( array(
		'id'          => '_pricing_table_',
		'type'        => 'group',
		
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __('Pricing Table Title', 'alpha'),
		'id'   => 'pt_title',
		'type' => 'text',
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __('Pricing Option', 'alpha'),
		'id'   => 'pt_option',
		'type' => 'text',
		'repeatable' => true, 
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __('Price', 'alpha'),
		'id'   => 'pt_price',
		'type' => 'text',
	) );
}
add_action( 'cmb2_init', 'cmb2_pricing_table_metabox' );

// Services
function cmb2_services_metabox() {
	$prefix = '_alpha_';

	$cmb = new_cmb2_box( array(
        'id'           => $prefix . 'services',
        'title'        => __( 'Services', 'alpha' ),
        'object_types' => array( 'page' ),
        'context'      => 'normal',
        'priority'     => 'default',
    ) );

	$group_field_id = $cmb->add_field( array(
		'id'          => '_services_',
		'type'        => 'group',
		
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __('Icon', 'alpha'),
		'id'   => 'services_icon',
		'type' => 'text',
		'attributes'  => array(
			'placeholder' => 'FA-4.7 Ex: fa fa-facebook',
		),
	) );

	$cmb->add_group_field( $group_field_id, array(
		'name' => __('Title', 'alpha'),
		'id'   => 'services_title',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_field_id, array(
		'name' => __('Description', 'alpha'),
		'id'   => 'services_description',
		'type' => 'textarea',
	) );
}
add_action( 'cmb2_init', 'cmb2_services_metabox' );