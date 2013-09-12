drupal-image_crop
=================

Image crop module for drupal

install 'image_crop' module into your drupal instance

At the install, the module will generate many new images styles

Example :
=================

Default :
---
- Thumbnail (100x100)
- Medium (220x220)
- Large (480x480)

Generated image style :
---
- large_center_bottom
- large_center_center
- large_center_top
- large_left_center
- large_right_center
- medium_center_bottom
- medium_center_center
- medium_center_top
- medium_left_center
- medium_right_center
- thumbnail_center_bottom
- thumbnail_center_center
- thumbnail_center_top
- thumbnail_left_center
- thumbnail_right_center

The configuration page allow you to change the cropping ratio
/admin/config/media/image-crop

Explanation :
---
If ratio = 1.5
Thumbnail size = 100x100
BEFORE CROPPING : thumbnail_center_top size = 150x150
AFTER CROPPING : thumbnail_center_top size = 100x100

_center_top mean that 50 pixel are removed from the right and bottom

_center_bottom mean that 50 pixel are removed from the right and top

Regenerate image style after add a new one :
---
/admin/config/media/image-crop

Click "Save configuration", previous generated style will be removed and recreated
