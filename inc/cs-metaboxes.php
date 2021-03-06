<?php
function mt_companion_cs_framework_options($options) {
    /**
     * Course MetaBox Information
     */
    $options[] = array(
        'id'        => 'course-meta-info',
        'title'     => __('Course Settings', 'mt_companion'),
        'post_type' => 'course',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'course-contents',
                'title'  => __('Course Information', 'mt_companion'),
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'      => 'intro_video_check',
                        'type'    => 'switcher',
                        'title'   => 'Display Introductory Video Of this Course:',
                        'default' => false
                    ),
                    array(
                        'id'    => 'intro_video',
                        'type'  => 'text',
                        'title' => __('Course Introduction Video ID', 'mt_companion'),
                        'dependency' => array( 'intro_video_check', '==', 'true' ) // dependency rule
                    ),
                    array(
                        'id'      => 'intro_video_type',
                        'type'    => 'select',
                        'title'   => __('Type of the Video', 'mt_companion'),
                        'options' => array(
                            'vimeo'   => "Vimeo",
                            'youtube' => 'YouTube',
                        ),
                        'dependency' => array( 'intro_video_check', '==', 'true' )
                    ),
                    array(
                        'id'             => 'wc_product',
                        'type'           => 'select',
                        'title'          => 'Select WooCommerce Product',
                        'options'        => 'posts',
                        'query_args'     => array(
                            'post_type' => 'product',
                        ),
                        'default_option' => 'Select a Product',
                    ),

                    array(
                        'id'              => 'chapters',
                        'type'            => 'group',
                        'title'           => __('Chapters', 'mt_companion'),
                        'button_title'    => __('New chapter', 'mt_companion'),
                        'accordion_title' => __('Add New Chapter', 'mt_companion'),
                        'fields'          => array(
                            array(
                                'id'             => 'course-chapter',
                                'type'           => 'select',
                                'title'          => 'Selected Chapter',
                                'options'        => 'posts',
                                'query_args'     => array(
                                    'post_type' => 'chapter',
                                    'post_status' =>'publish',
                                    'posts_per_page' => -1,
                                ),
                                'default_option' => 'Select a Chapter',
                            ),
                        ),
                    ),

                )
            ),
        )
    );


    /**
     * Chapter MetaBox Information
     */

    $options[] = array(
        'id'        => 'chapter-data',
        'title'     => 'Contents of The Chapter',
        'post_type' => 'chapter', // or post or CPT or array( 'page', 'post' )
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(

            // begin section
            array(
                'name'   => 'chapter_contents',
                'title'  => __('Contents Of This Chapter','mt_companion'),
                'icon'   => 'fa fa-wifi',
                'fields' => array(

                    array(
                        'id'              => 'content-group',
                        'type'            => 'group',
                        'title'           => 'Contents',
                        'button_title'    => __('Add Content','mt_companion'),
                        'accordion_title' => __('New Content','mt_companion'),
                        'fields'          => array(

                            array(
                                'id'             => 'chapter-content',
                                'type'           => 'select',
                                'title'          => __('Content','mt_companion'),
                                'options'        => 'posts',
                                'query_args'     => array(
                                    'post_type' => 'course-contents',
                                    'post_status' =>'publish',
                                    'posts_per_page' => -1,
                                ),
                                'default_option' => 'Select a content',
                            ),

                        ),
                    ),

                ),
            ),
        )
    );


    /**
     * course-contents MetaBox Information
     */

    $options[] = array(
        'id'        => 'course-meta',
        'title'     => 'Course Material',
        'post_type' => 'course-contents', // or post or CPT or array( 'page', 'post' )
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(

            // begin section
            array(
                'name'   => 'video-information',
                'title'  => 'Course Video Information',
                'icon'   => 'fa fa-heart',
                'fields' => array(
                    array(
                        'id'      => 'video-check',
                        'type'    => 'switcher',
                        'title'   => 'Has Video',
                        'label'   => 'Do you want to add a video ?',
                        'default' => 0
                    ),
                    array(
                        'id'         => 'video-type',
                        'type'       => 'select',
                        'title'      => 'Add video from:',
                        'options'    => array(
                            'youtube' => 'YouTube',
                            'vimeo'   => 'Vimeo'
                        ),
                        'default'    => 'youtube',
                        'dependency' => array('video-check', '==', '1')
                    ),
                    array(
                        'id'         => 'youtube-video',
                        'type'       => 'text',
                        'title'      => 'Enter YouTube Video ID',
                        'dependency' => array('video-check|video-type', '==|==', '1|youtube')
                    ),
                    array(
                        'id'         => 'vimeo-video',
                        'type'       => 'text',
                        'title'      => 'Enter Vimeo Video ID',
                        'dependency' => array('video-check|video-type', '==|==', '1|vimeo')
                    ),
                    array(
                        'id'         => 'video-duration',
                        'type'       => 'text',
                        'title'      => 'Enter Video Duration',
                        'attributes' => array(
                            'placeholder' => 'In minute. Eg- 4:30',
                        ),
                        'dependency' => array('video-check', '==', '1')
                    ),

                ),
            ),
        )
    );

    return $options;
}

add_filter('cs_metabox_options', 'mt_companion_cs_framework_options');