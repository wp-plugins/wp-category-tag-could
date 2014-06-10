<?php

/**
 * Created by PhpStorm.
 * User: benohead
 * Date: 09.05.14
 * Time: 13:55
 */
class WPCTC_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'wpctc_widget',
            __('Category Tag Cloud', 'wpctc_widget_domain'),
            array('description' => __('WP Category Tag Cloud', 'wpctc_widget_domain'),)
        );
    }

    public function widget($args, $instance)
    {
        global $wpdb;

        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        $tags = $wpdb->get_results
            ("
			SELECT DISTINCT tt2.term_id AS tag_id
			FROM wp_posts as posts
				INNER JOIN wp_term_relationships as tr1 ON posts.ID = tr1.object_ID
				INNER JOIN wp_term_taxonomy as tt1 ON tr1.term_taxonomy_id = tt1.term_taxonomy_id
				INNER JOIN wp_term_relationships as tr2 ON posts.ID = tr2.object_ID
				INNER JOIN wp_term_taxonomy as tt2 ON tr2.term_taxonomy_id = tt2.term_taxonomy_id
				INNER JOIN wp_term_relationships as tr3 ON posts.ID = tr3.object_ID
				INNER JOIN wp_term_taxonomy as tt3 ON tr3.term_taxonomy_id = tt3.term_taxonomy_id
			WHERE posts.post_status = 'publish'
                AND tt1.taxonomy = 'category'" .
                (isset($instance['category_id']) && count($instance['category_id']) > 0 ? "AND tt1.term_id IN (" . implode(",", $instance['category_id']) . ")" : "") . "
                AND tt2.taxonomy = '" . $instance['taxonomy'] . "'
                AND tt3.taxonomy = 'post_tag'" .
                (isset($instance['tag_id']) && count($instance['tag_id']) > 0 ? "AND tt3.term_id IN (" . implode(",", $instance['tag_id']) . ")" : "") . "
        ");
        $includeTags = '';
        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                if (count($instance['tag_id']) > 0 && !in_array($tag->tag_id, $instance['tag_id'])) continue;
                $includeTags = $tag->tag_id . ',' . $includeTags;
            }
        }
        $cloud_args = array(
            'smallest' => $instance['smallest'],
            'largest' => $instance['largest'],
            'unit' => '%',
            'number' => $instance['number'],
            'format' => $instance['format'],
            'orderby' => $instance['order_by'],
            'order' => $instance['order'],
            'include' => null,
            'topic_count_text_callback' => default_topic_count_text,
            'link' => 'view',
            'taxonomy' => $instance['taxonomy'],
            'echo' => $instance['format'] != 'array',
        );
        if (strlen($includeTags > 0)) {
            $cloud_args['include'] = $includeTags;
        }
        ?>
        <div id="tagcloud">
            <?php
            if ($instance['format'] != 'array') {
                wp_tag_cloud($cloud_args);
            } else {
                $tags = wp_tag_cloud($cloud_args);
                ?>
                <canvas id="<?php echo $args['widget_id']; ?>_canvas" class="tagcloud-canvas">
                </canvas>
            <?php
            }
            ?>
        </div>
        <div id="<?php echo $args['widget_id']; ?>_canvas_tags">
            <ul>
                <?php foreach ($tags as $tag) { ?>
                    <li><?php echo($tag); ?></li>
                <?php } ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : __('New title', 'wpctc_widget_domain');
        $category_id = isset($instance['category_id']) ? $instance['category_id'] : array();
        $tag_id = isset($instance['tag_id']) ? $instance['tag_id'] : array();
        $order_by = isset($instance['order_by']) ? $instance['order_by'] : 'name';
        $order = isset($instance['order']) ? $instance['order'] : 'ASC';
        $format = isset($instance['format']) ? $instance['format'] : 'flat';
        $number = isset($instance['number']) ? $instance['number'] : '0';
        $taxonomy = isset($instance['taxonomy']) ? $instance['taxonomy'] : 'post_tag';
        $smallest = isset($instance['smallest']) ? $instance['smallest'] : '75';
        $largest = isset($instance['largest']) ? $instance['largest'] : '200';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Display:'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('taxonomy'); ?>"
                    name="<?php echo $this->get_field_name('taxonomy'); ?>" class="widefat">
                <?php
                $taxonomies = get_taxonomies('', 'objects');
                foreach ($taxonomies as $field) {
                    ?>
                    <option
                        value="<?php echo($field->name); ?>" <?php selected($field->name, $taxonomy); ?>><?php echo $field->label; ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Max displayed items:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>"
                   name="<?php echo $this->get_field_name('number'); ?>" type="text"
                   value="<?php echo esc_attr($number); ?>"/>
            <small><em><?php _e('0 means display all'); ?></em></small>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('category_id'); ?>"><?php _e('Categories:'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('category_id'); ?>"
                    name="<?php echo $this->get_field_name('category_id'); ?>[]" size=3 multiple="multiple"
                    class="widefat"
                    style="height: auto;">
                <?php
                $categories = get_categories(array('hide_empty' => 0));

                if ($categories) {
                    foreach ($categories as $category) {
                        $category->name = wp_specialchars($category->name);
                        ?>
                        <option value="<?php echo($category->term_id); ?>"
                        <?php
                        if (in_array($category->term_id, $category_id)) {
                            echo("selected='selected'");
                        }
                       echo ">$category->name</option>";
                    }
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tag_id'); ?>"><?php _e('Tags:'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('tag_id'); ?>"
                    name="<?php echo $this->get_field_name('tag_id'); ?>[]" size=3 multiple="multiple" class="widefat"
                    style="height: auto;">
                <?php
                $tags = get_tags(array('hide_empty' => 0));

                if ($tags) {
                    foreach ($tags as $tag) {
                        $tag->name = wp_specialchars($tag->name);
                        ?>
                        <option value="<?php echo($tag->term_id); ?>"
                        <?php
                        if (in_array($tag->term_id, $tag_id)) {
                            echo("selected='selected'");
                        }
                       echo ">$tag->name</option>";
                    }
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order_by'); ?>"><?php _e('Order By:'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('order_by'); ?>"
                    name="<?php echo $this->get_field_name('order_by'); ?>" class="widefat">
                <?php
                $taxonomies = array('name' => __('Name'), 'count' => __('Count'));
                foreach ($taxonomies as $field_id => $field_name) {
                    ?>
                    <option
                        value="<?php echo($field_id); ?>" <?php selected($field_id, $order_by); ?>><?php echo $field_name; ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('order'); ?>"
                    name="<?php echo $this->get_field_name('order'); ?>" class="widefat">
                <?php
                $taxonomies = array('ASC' => __('Ascending'), 'DESC' => __('Descending'), 'RAND' => __('Random'));
                foreach ($taxonomies as $field_id => $field_name) {
                    ?>
                    <option
                        value="<?php echo($field_id); ?>" <?php selected($field_id, $order); ?>><?php echo $field_name; ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('format'); ?>"><?php _e('Format:'); ?></label><br/>
            <select id="<?php echo $this->get_field_id('format'); ?>"
                    name="<?php echo $this->get_field_name('format'); ?>" class="widefat">
                <?php
                $taxonomies = array('flat' => __('Separated by whitespace'), 'list' => __('UL with a class of wp-tag-cloud'), 'array' => __('3D HTML5 Cloud'));
                foreach ($taxonomies as $field_id => $field_name) {
                    ?>
                    <option
                        value="<?php echo($field_id); ?>" <?php selected($field_id, $format); ?>><?php echo $field_name; ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('smallest'); ?>"><?php _e('Size of the smallest item (in %):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('smallest'); ?>"
                   name="<?php echo $this->get_field_name('smallest'); ?>" type="text"
                   value="<?php echo esc_attr($smallest); ?>"/>
        </p>
        <p>
            <label
                for="<?php echo $this->get_field_id('largest'); ?>"><?php _e('Size of the largest item (in %):'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('largest'); ?>"
                   name="<?php echo $this->get_field_name('largest'); ?>" type="text"
                   value="<?php echo esc_attr($largest); ?>"/>
        </p>
    <?php
    }

    // Updating widget replacing old instances with new
    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['category_id'] = $new_instance['category_id'];
        $instance['tag_id'] = $new_instance['tag_id'];
        $instance['order_by'] = isset($new_instance['order_by']) && strlen($new_instance['order_by']) > 0 ? $new_instance['order_by'] : 'name';
        $instance['order'] = isset($new_instance['order']) && strlen($new_instance['order']) > 0 ? $new_instance['order'] : 'ASC';
        $instance['format'] = isset($new_instance['format']) && strlen($new_instance['format']) > 0 ? $new_instance['format'] : 'flat';
        $instance['number'] = isset($new_instance['number']) && (is_int($new_instance['number']) || ctype_digit($new_instance['number'])) ? $new_instance['number'] : 0;
        $instance['taxonomy'] = isset($new_instance['taxonomy']) && strlen($new_instance['taxonomy']) > 0 ? $new_instance['taxonomy'] : 'post_tag';
        $instance['smallest'] = isset($new_instance['smallest']) && (is_int($new_instance['smallest']) || ctype_digit($new_instance['smallest'])) ? $new_instance['smallest'] : 75;
        $instance['largest'] = isset($new_instance['largest']) && (is_int($new_instance['largest']) || ctype_digit($new_instance['largest'])) ? $new_instance['largest'] : 200;
        return $instance;
    }
} // Class wpctc_widget ends here

// Register and load the widget
function wpctc_load_widget()
{
    register_widget('wpctc_widget');
}

add_action('widgets_init', 'wpctc_load_widget');