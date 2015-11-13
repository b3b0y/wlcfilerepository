	<?php
	//Open FTP connection
		if($listing_mode == 1)
		{
			$ftp_stream = ftp_connect($ftp_host) or die(display_error_message("<b>Could not connect to FTP host</b>"));
			@ftp_login($ftp_stream, $ftp_username, $ftp_password) or die(display_error_message("<b>Could not login to FTP host</b>"));
		}
		//Open FTP connection -done

		$folder_exists = true;
		//Check if directory exists
		if($listing_mode == 0)
			$folder_exists = (is_dir($dir_to_browse1)) ? false : true; //HTTP
		elseif($listing_mode == 1 && PHP_VERSION >= 5)
			$folder_exists = (!is_dir('ftp://'.$ftp_username.':'.$ftp_password.'@'.$ftp_host.$dir_to_browse1)) ? false : true; //FTP

		
		//Chcek if directory exists -done

		//This is a VERY important security feature. It prevents people from browsing directories above $dir_to_browse1 and any excluded folders. Edit this part at your own risk
		if(count(explode("../",$folder)) > 1 || in_array(basename($url_folder), $exclude))
		{
			echo display_error_message("<b>Access Denied</b>");
			exit;
		}

		if(strlen($url_folder) == 2 && $url_folder == "..")
		{
			echo display_error_message("<b>Access Denied</b>");
			exit;
		}
		//Seurity feature -done

		//Calculate table dimensions
		$table_width = 50+$width_of_files_column+$width_of_sizes_column+$width_of_dates_column;

		//Any upload error is displayed here
		switch(base64_decode($_GET['err']))
		{
			case "upload_banned": echo display_error_message("<b><script> alert('Upload failed, banned file type ');</script></b>")."<br/>";break;
			case "upload_error": echo display_error_message("<b><script> alert('Upload failed, an unknown error occured');</script></b>")."<br />";break;
			case "size": echo display_error_message("<b>File size exceeded limit. Max allowed is ".max_upload_size()."B</b>")."<br />";break;
			case "nofile": echo display_error_message("<b>Please select a file to upload!</b>")."<br />";break;
		}
		//Any upload error is displayed here -done

		//Change excluded extensions to lowercase if $case_sensative_ext is disabled
		if($case_sensative_ext == 0)
			foreach($exclude_ext as $key => $val)
				$exclude_ext[$key] = strtolower($val);

		//Initialize arrays
		$folders = array();
		$files = array();
		//initialize arrays -done

		//Get directory content seperatiung files and folders into 2 arrays and filtering them to remove those exlcluded
		$dir_content = get_dir_content($dir_to_browse1);

		$folders['name'] = $dir_content['folders']['name'];
		$folders['date'] = $dir_content['folders']['date'];
		$folders['link'] = $dir_content['folders']['link'];
		$files['name'] = $dir_content['files']['name'];
		$files['size'] = $dir_content['files']['size'];
		$files['date'] = $dir_content['files']['date'];
		$files['link'] = $dir_content['files']['link'];
		$images_detected = $dir_content['images_detected'];
		$media_detected = $dir_content['media_detected'];

		//The folder size calculation has not been placed inside the get_dir_content function so as not to affect it's speed. This is important becasue folder_size calls upon get_dir_content
		if($view_mode == 1)
		{
			if($show_folder_size_http == 1 && $listing_mode == 0)
				foreach($folders['name'] as $key => $val)
					$folders['size'][$key] = folder_size($dir_to_browse1.$folders['name'][$key]);
			elseif($show_folder_size_ftp == 1 && $listing_mode == 1)
				foreach($folders['name'] as $key => $val)
					$folders['size'][$key] = folder_size($dir_to_browse1.$folders['name'][$key]);
			else
				$folders['size'][$key] = array();
		}
		//Get directory content -done

		//Sort the folders and files array
		//User sorted
		if(isset($_SESSION['sort']))
		{
			$sort_by = $_SESSION['sort']['by'];
			$sort_order = $_SESSION['sort']['order'];
		}

		if(!empty($folders['name']))
		{
			if($sort_by == 0)
			{
				natcasesort($folders['name']);
				$folders_sorted = $folders['name'];
			}
			elseif($sort_by == 1 && $listing_mode == 0 && $show_folder_size_http == 1)//Sort by size for HTTP listing
			{
				asort($folders['size'], SORT_NUMERIC);
				$folders_sorted = $folders['size'];
			}
			elseif($sort_by == 1 && $listing_mode == 1 && $show_folder_size_ftp == 1)//Sort by size for FTP listing
			{
				asort($folders['size'], SORT_NUMERIC);
				$folders_sorted = $folders['size'];
			}
			else
				$folders_sorted = sort_by_date($folders['date']);
			
			if($sort_order == 1)
				$folders_sorted = array_reverse($folders_sorted, TRUE);
				
		}
		else
			$folders_sorted = array();//if there are no folders in the current directory
			
		if(!empty($files['name']))
		{
			if($sort_by == 0)
			{
				natcasesort($files['name']);//natcasesort preserves the array keys
				$files_sorted = $files['name'];
			}
			elseif($sort_by == 1)
			{
				asort($files['size'], SORT_NUMERIC);
				$files_sorted = $files['size'];
			}
			else
				$files_sorted = sort_by_date($files['date'], $sort_order);	
			
			if($sort_order == 1)
				$files_sorted = array_reverse($files_sorted, TRUE);
		}
		else
			$files_sorted = array();//if there are no files in the current directory
		//Sort the folders and files array -done

		//Icons
		if($view_mode == 0)
		{
			$files_icons_array = icons($files['name'], $view_mode);
			$folder_icon = ($view_mode == 0) ? '<img border="0" src="dirLIST_files/icons_large/folder.png">':'<img src="dirLIST_files/icons/folder.gif"> ';
		}
		elseif($view_mode == 1 && $file_icons)
		{
			$files_icons_array = icons($files['name'], $view_mode);
			$folder_icon = ($view_mode == 0) ? '<img border="0" src="dirLIST_files/icons_large/folder.png">':'<img src="dirLIST_files/icons/folder.gif"> ';
		}
		//Icons -done

		//Hide file extensions if enabled
		$files['name_with_ext'] = $files['name'];
		if($hide_file_ext == 1)
		{
			foreach($files['name'] as $key => $val)
			{
				$files['name'][$key] = remove_ext($val);
			}
		}
		//Hide file extensions if enabled -done

	if(!empty($folders['name']) || !empty($files['name'])) 
	{ 
	
		if($view_mode == 0) //thumbnail mode
		{
			$cells_thumbs = array();
			$cells_names = array();
			$folders_counter = 0;
			$files_counter = 0;
			$img_thumbs_counter = 0;
			
			foreach($folders_sorted as $key => $val)//This part is for the folders
			{
				$cells_thumbs[] = ' <div class="variant-wraper"> <div class="variant-image"> <a id="click'.$folders_counter.'" href="'.$this_file_name.'?folder='.base64_encode($folders['link'][$key]).'"><img border="0" style="cursor:pointer"  onclick="show_div(0, \''.$folders_counter.'\');" src="dirLIST_files/icons_large/folder.png"></a> </div>'."\n";
				
				$cell_name = '';
			
				$cell_name .= '<div class="variant-desc"> <span class="variant-title"> ';
				
				$cell_name .= '<a id="clickf'.$folders_counter.'" href="'.$this_file_name.'?folder='.base64_encode($folders['link'][$key]).'" >'.chunk_split($folders['name'][$key], 15, "<br />").'</a>';
				
				$cell_name .= '</span> </div>';
				//$cell_name .= '<div tsyle="float:right"><img border="0" src="dirLIST_files/edit_files/edit.png" onclick="show_div(0, \''.$folders_counter.'\');" style="cursor:pointer"></div>';
				
				$cells_names[] = $cell_name.'</div>'."\n";
				
				$folders_counter++;
			}
			


			foreach($files_sorted as $key => $val)//This part is for the files
			{
				$file_class = ($files_counter%2 == 0) ? "file_bg1" : "file_bg2";
				//$file_link = ($limit_download_speed == 1 || $listing_mode == 1) ? 'dirLIST_files/download.php?file='.base64_encode($files['link'][$key]):$files['link'][$key];
				
				if(in_array(strtolower(strrchr($files['name'][$key], '.')), $thumb_types) && $display_image_thumbs == 1)
				{	
					//signifies it's an image and a thumbnail is to be displayed
					$cells_thumbs[] = '<div class="variant-wraper '.$file_class.'"> <div class="variant-image"> <a id="clickf'.$files_counter.'"  target="_blank" ><img style="cursor:pointer"  onclick="show_div(1, \''.$files_counter.'\');" id="img_thumb_'.$img_thumbs_counter.'" link_att="'.rawurlencode($files['link'][$key]).'" src="dirLIST_files/icons_large/loading'.$color_scheme_code.'.gif" border="0" /></a></div>'."\n";
					$img_thumbs_counter++;
				}
				else
				{
					$cells_thumbs[] = '<div class="variant-wraper '.$file_class.'"> <div class="variant-image"> <a id="clickf'.$files_counter.'" target="_blank"><img style="cursor:pointer"  onclick="show_div(1, \''.$files_counter.'\');" border="0" src="dirLIST_files/icons_large/'.$files_icons_array[$key].'" /></a></div>'."\n";
				}
				
				$cell_name = '';
				$cell_name .= '<div class="variant-desc"> <span class="variant-title"> ';
				
				$cell_name .= '<a id="clickf'.$files_counter.'" >'.chunk_split($files['name'][$key], 15, "<br />").'</a>';
																
				$cells_names[] = $cell_name.'</span> </div> </div>'."\n";
				
				$files_counter++;
			}
			echo '<ul id="search-result-items" class="grid-view  clearfix thumbnail">';
			
			$items = 0;
			
			$total_items = count($cells_names);
			$number_of_rows = ceil($total_items/5);
			
			for($i=0;$i<$total_items;$i++)
			{
				
					$ctr++;
					echo '<li id="high'.$ctr.'" class="clearfix"> ';
					echo (!empty($cells_thumbs[$i])) ? $cells_thumbs[$i] : '';
					echo (!empty($cells_names[$i])) ? $cells_names[$i] : '';
					echo '</li>';
				
			}

			echo '</ul>';

		}
		else //list mode
		{
		?>
			<table width="100%" border="0" cellspacing="5" cellpadding="5" style="background:linear-gradient(to bottom, rgba(248,255,232,1) 0%,rgba(227,245,171,1) 33%,rgba(183,223,45,1) 100%);background:-moz-linear-gradient(center top , rgb(248, 255, 232) 0%, rgb(227, 245, 171) 33%, rgb(183, 223, 45) 100%) repeat scroll 0% 0% transparent;border-bottom:5px solid rgba(0, 0, 0, 0.3);font-size:14px;font-weight:bold;">
				    <tr>
				    	<td  width="<?PHP echo ($view_mode == 0) ? '414':$width_of_files_column; ?>" class="top_row"><a class="sort" href="dirLIST_files/sort.php?by=name&folder=<?PHP echo $_GET['folder']; ?>"><?PHP echo $local_text['name']; ?></a></td>
				    	<td width="<?PHP echo ($view_mode == 0) ? '128':$width_of_sizes_column; ?>" class="top_row"><a class="sort" href="dirLIST_files/sort.php?by=size&folder=<?PHP echo $_GET['folder']; ?>"><?PHP echo $local_text['size']; ?></a></td>
				    	<td width="<?PHP echo ($view_mode == 0) ? '128':$width_of_dates_column; ?>" class="top_row"><a class="sort" href="dirLIST_files/sort.php?by=date&folder=<?PHP echo $_GET['folder']; ?>"><?PHP echo $local_text['date_uploaded']; ?></a></td>
				  </tr>
				</table>
		<?php
			echo '<table width="100%" border="0" cellspacing="5" cellpadding="5">';
			$count = 0;
			foreach($folders_sorted as $key => $val)
			{
				
				echo '<tr class="folder_bg"><td width="'.$width_of_files_column.'">';
				echo '<div style="float:left;width:'.($width_of_files_column-40).'px">';
				if($file_icons == 1)
					echo '<a id="click'.$cnt.'" href="'.$this_file_name.'?folder='.base64_encode($folders['link'][$key]).'">'.'<img src="dirLIST_files/icons/folder.gif"> '.$folders['name'][$key].'</a>';

				echo ' </div>';
				
				echo '</td>';
				echo '<td width="'.$width_of_sizes_column.'">';
				
				if($listing_mode == 0 && $show_folder_size_http == 1)
					echo letter_size($folders['size'][$key]);
				elseif($listing_mode == 1 && $show_folder_size_ftp == 1)
					echo letter_size($folders['size'][$key]);
				else
					echo '-';
				
				echo '</td>
				<td width="'.$width_of_dates_column.'">'.$folders['date'][$key].'</td></tr>';
				$cnt++;
				$count++;
			}
			$count = 0;
			foreach($files_sorted as $key => $val)
			{
				
				if($count%2 == 0) $file_class = "file_bg1"; else $file_class = "file_bg2";
					echo '<tr class="'.$file_class.'">
				<td width="'.$width_of_files_column.'">';
				echo '<div style="float:left;width:'.($width_of_files_column-40).'px">';

				$file_link = ($limit_download_speed == 1 || $listing_mode == 1) ? 'dirLIST_files/download.php?file='.base64_encode($files['link'][$key]) :$files['link'][$key];
				
				if($file_icons == 1)
					echo ' <a id="clickf'.$cnt2.'" href="'.$file_link.'"> <img src="dirLIST_files/icons/'.$files_icons_array[$key].'"></a>';

				echo ' <a id="clickf'.$cnt2.'" href="'.$file_link.'">'.$files['name'][$key].'</a></div>';

				echo '</td>';
				
				echo '<td width="'.$width_of_sizes_column.'">'.letter_size($files['size'][$key]).'</td>
				<td width="'.$width_of_dates_column.'">'.$files['date'][$key].'</td></tr>';
				$cnt2++;
				$count++;
				echo '';

			}
			echo '</table>';
			}
		//Palce the content into a table -done
	}

		//Output if the directory is empty
	if(empty($folders['name']) && empty($files['name'])) 
	echo display_error_message('This folder is empty');
	//Output if the directory is empty -done