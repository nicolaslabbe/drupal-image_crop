<?php

/**
 * Return TRUE | FALSE if image style name match plugin image style name
 * @param (String) $name
 * @return (Boolean) $bool
 */
function isImageCropStyles ($name)
{
	$bool = false;
	if(strpos($name, "_center_top")) {
		$bool = true;
	}else if(strpos($name, "_center_center")) {
		$bool = true;
	}else if(strpos($name, "_center_bottom")) {
		$bool = true;
	}else if(strpos($name, "_left_center")) {
		$bool = true;
	}else if(strpos($name, "_right_center")) {
		$bool = true;
	}
	return $bool;
}

/**
 * Simple function to create image style into drupal 7
 * @param (String) $name
 * @param (Array) $effects
 * @return (void)
 */
function createImageStyle ($name, $effects)
{
    $style = image_style_save(array('name' => $name));
    foreach ($effects as $key => $effect) {
        $effect['isid'] = $style['isid'];
        image_effect_save($effect);
    }
}

/**
 * Concat old image style to new image style
 * @param (String) $name
 * @param (Array) $effects
 * @return (void)
 */
function createImageCropStylesFromOldStyle ($name, $effects)
{
	$width = 0;
	$height = 0;
	$ratio = variable_get('image_crop_ration');
	$imageNewStyle = array(
		'_center_top' => 'center-top',
		'_center_center' => 'center-center',
		'_center_bottom' => 'center-bottom',
		'_left_center' => 'left-center',
		'_right_center' => 'right-center'
	);
	
	// get old width and height
	foreach ($effects as $key => $value) {
		$width = $value['data']['width'];
		$height = $value['data']['height'];
		
		$effects[$key]['data']['width'] = $width * $ratio;
		$effects[$key]['data']['height'] = $width * $ratio;
	}
	
	// get old width and height
	$pos = count($effects);
	foreach ($imageNewStyle as $key => $value) {
		$effects[$pos] = array(
            'label' => 'Crop',
            'name' => 'image_crop',
            'data' => array(
                'width' => $width,
                'height' => $height,
                'anchor' => $value,
            )
        );
		
		createImageStyle($name . $key, $effects);
	}
}

/**
 * Call this method to delete all image style from plugin
 * @param (null)
 * @return (void)
 */
function deleteImageStyle ()
{
	// first remove image style created with plugin
	$images_style = image_styles();
	foreach ($images_style as $key => $value) {
		if(isImageCropStyles($key)) {
			image_style_delete(image_style_load($key));
			drupal_set_message('Image crop style ' . $key . ' deleted successfully');
		}
	}
}

/**
 * Call this method to recreate all image style from plugin
 * @param (null)
 * @return (void)
 */
function reCreateImageStyle ()
{
	// then recreate image style needed by plugin
	$images_style = image_styles();
	foreach ($images_style as $key => $value) {
	    createImageCropStylesFromOldStyle($key, $value['effects']);
		drupal_set_message('Image crop style for entry ' . $key . ' created successfully');
	}
}

//deleteImageStyle();
//reCreateImageStyle();