<?php 
/***********************************************************************
* @Author: Boutros AbiChedid
* @Date:   February 14, 2011
* @Copyright: Boutros AbiChedid (http://bacsoftwareconsulting.com/)
* @Licence: Feel free to use it and modify it to your needs but keep the
* Author's credit. This code is provided 'as is' without any warranties.
* @Function Name:  wp_bac_breadcrumb()
* @Version:  1.0 -- Tested up to WordPress version 3.1.2
* @Description: WordPress Breadcrumb navigation function. Adding a
* breadcrumb trail to the theme without a plugin.
* This code does not support multi-page split numbering, attachments,
* custom post types and custom taxonomies.
***********************************************************************/
 
function libero_wp_bac_breadcrumb() { 
	
    //Variable (symbol >> encoded) and can be styled separately.
    //Use >> for different level categories (parent >> child >> grandchild)
            $delimiter = '<span class="delimiter"> &raquo; </span>';
    //Use bullets for same level categories ( parent . parent )
    $delimiter1 = '<span class="delimiter1"> &bull; </span>';
     
    //text link for the 'Home' page
            $main = esc_html__('Home','libero'); 
    //Display only the first 30 characters of the post title.
            $maxLength= 30;
     
    //variable for archived year
    $arc_year = get_the_time('Y');
    //variable for archived month
    $arc_month = get_the_time('F');
    //variables for archived day number + full
    $arc_day = get_the_time('d');
    $arc_day_full = get_the_time('l'); 
     
    //variable for the URL for the Year
    $url_year = get_year_link($arc_year);
    //variable for the URL for the Month   
    $url_month = get_month_link($arc_year,$arc_month);
 
    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
     
    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page()) {        
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
        echo '<ul class="breadcrumb">';
         
        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;        
        //A safe way of getting values for a named option from the options database table.
        $homeLink = home_url('/'); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        echo '<li><a href="' . esc_url($homeLink) . '">' . $main . '</a></li>';   
         
        //Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.          
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $num_cat = count($category); //counts the number of categories the post is listed in.
             
            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
			if ($num_cat <=1 && $num_cat != 0 )  //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                echo '<li>'. get_category_parents($category[0],  true,' ') .'</li>';
                //Display the full post title.
                echo '<li class="active">' . get_the_title() .'</li>';
            }
            //then the post is listed in more than 1 category. 
            elseif( $num_cat > 1 ) {
                //Put bullets between categories, since they are at the same level in the hierarchy.
                echo '<li>';
				foreach( get_the_category() as $key=>$rst_category ) { 
					echo '<a href="'. esc_url( get_term_link( $rst_category, 'category' ) ) .'">'. $rst_category->name .'</a>';
					if( $key < sizeof(get_the_category())-1 ) {
						echo ', ';
					}
				}
				echo '</li>';
                    
                echo '<li class="active">' . get_the_title() .'</li>';
            }
			else {
				echo '<li class="active">' . get_the_title() .'</li>';
			}
        }
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            //If it is a subcategory, it will display the full path to the subcategory.
            //Returns the parent categories of the current category with links separated by '»'
            echo '<li class="active">'. substr(get_category_parents($cat, true,' | '),0 ,strlen(get_category_parents($cat, true,' | '))-2) . '</li>' ;
        }      
        //Display breadcrumb for tag archive       
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo '<li class="active">'. esc_html__('Posts tagged with','libero') .': "' . single_tag_title("", false) . '"'. '</li>';
        }       
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            echo '<li><a href="' . esc_url($url_year) . '">' . $arc_year . '</a></li>';
            echo '<li><a href="' . esc_url($url_month) . '">' . $arc_month . '</a> ' . $arc_day . ' (' . $arc_day_full . ')</li>';
        }
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            echo '<li class="active"><a href="' . esc_url($url_year) . '">' . $arc_year . '</a> ' . $arc_month . '</li>';
        }
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            echo '<li class="active">'. $arc_year .'</li>';
        }      
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed.
            echo '<li class="active">'. esc_html__('Search results for','libero') .' "'. get_search_query() .'"</li>';
        }      
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            echo '<li class="active">'. get_the_title() .'</li>';
        }          
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.               
            $post_array = get_post_ancestors($post);
             
            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array);
             
            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo '<li><a href="' . get_permalink($post_ids) . '">' . $title . '</a> </li>';
            }
			echo '<li class="active">';
            the_title(); //returns the title of the current page.           
			echo '</li>';
        }          
        //Display breadcrumb for author archive  
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo  '<li class="active">'. esc_html__('Posts by','libero') .': ' . $user_info->display_name .'</li>';
        }      
        //Display breadcrumb for 404 Error
        elseif ( is_404() ) {//checks if 404 error is being displayed
            echo  '<li class="active">'. esc_html__('Error 404 - Not Found.','libero') .'</li>';
        }      
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
       echo '</ul>';
    }  
}
?>