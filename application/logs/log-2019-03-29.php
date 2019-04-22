<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-03-29 11:34:45 --> Query error: Unknown column 'posts_created_at' in 'where clause' - Invalid query: SELECT *
FROM `posts`
LEFT JOIN `media` ON `posts`.`post_image` = `media`.`media_id`
WHERE `post_type` = 7
AND `posts_created_at` > '2019-03-29 11:34:45'
ORDER BY 1 ASC
ERROR - 2019-03-29 11:35:17 --> Query error: Unknown column 'posts_created_at' in 'where clause' - Invalid query: SELECT *
FROM `posts`
LEFT JOIN `media` ON `posts`.`post_image` = `media`.`media_id`
WHERE `post_type` = 7
AND `posts_created_at` > '2019-03-29 11:35:17'
ORDER BY 1 ASC
ERROR - 2019-03-29 11:35:37 --> Query error: Unknown column 'posts_created_at' in 'where clause' - Invalid query: SELECT *
FROM `posts`
LEFT JOIN `media` ON `posts`.`post_image` = `media`.`media_id`
WHERE `post_type` = 7
AND `posts_created_at` > '2019-03-29 11:35:37'
ORDER BY `post_created_at` ASC
