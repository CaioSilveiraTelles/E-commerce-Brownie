/* global jQuery:false */
/* global CHOCOROCCO_STORAGE:false */

jQuery(document).ready(function() {
	"use strict";


	// Hide empty meta-boxes
	jQuery('.postbox > .inside').each(function() {
		if (jQuery(this).html().length < 5) jQuery(this).parent().hide();
	});

	// Hide admin notice
	jQuery('#chocorocco_admin_notice .chocorocco_hide_notice').on('click', function(e) {
		jQuery('#chocorocco_admin_notice').slideUp();
		jQuery.post( CHOCOROCCO_STORAGE['ajax_url'], {'action': 'chocorocco_hide_admin_notice'}, function(response){});
		e.preventDefault();
		return false;
	});
	



	// TGMPA Source selector is changed
	jQuery('.tgmpa_source_file').on('change', function(e) {
		var chk = jQuery(this).parents('tr').find('>th>input[type="checkbox"]');
		if (chk.length == 1) {
			if (jQuery(this).val() != '')
				chk.attr('checked', 'checked');
			else
				chk.removeAttr('checked');
		}
	});



	// Add icon selector after the menu item classes field
	jQuery('.edit-menu-item-classes')
		.on('change', function() {
			var icon = chocorocco_get_icon_class(jQuery(this).val());
			var selector = jQuery(this).next('.chocorocco_list_icons_selector');
			selector.attr('class', chocorocco_chg_icon_class(selector.attr('class'), icon));
			if (!icon)
				selector.css('background-image', '');
			else if (icon.indexOf('image-') >= 0) {
				var list = jQuery('.chocorocco_list_icons');
				if (list.length > 0) {
					var bg = list.find('.'+icon.replace('image-', '')).css('background-image');
					if (bg && bg!='none') selector.css('background-image', bg);
				}
			}
		})
		.each(function() {
			jQuery(this).after('<span class="chocorocco_list_icons_selector" title="'+CHOCOROCCO_STORAGE['icon_selector_msg']+'"></span>');
			jQuery(this).trigger('change');
		})

	jQuery('.chocorocco_list_icons_selector').on('click', function(e) {
		var selector = jQuery(this);
		var input_id = selector.prev().attr('id');
		if (input_id === undefined) {
			input_id = ('chocorocco_icon_field_'+Math.random()).replace(/\./g, '');
			selector.prev().attr('id', input_id)
		}
		var in_menu = selector.parents('.menu-item-settings').length > 0;
		var list = in_menu ? jQuery('.chocorocco_list_icons') : selector.next('.chocorocco_list_icons');
		if (list.length > 0) {
			if (list.css('display')=='none') {
				list.find('span.chocorocco_list_active').removeClass('chocorocco_list_active');
				var icon = chocorocco_get_icon_class(selector.attr('class'));
				if (icon != '') list.find('span[class*="'+icon.replace('image-', '')+'"]').addClass('chocorocco_list_active');
				var pos = in_menu ? selector.offset() : selector.position();
				list.data('input_id', input_id).css({'left': pos.left-(in_menu ? 0 : list.outerWidth()-selector.width()-1), 'top': pos.top+(in_menu ? 0 : selector.height()+4)}).fadeIn();
			} else
				list.fadeOut();
		}
		e.preventDefault();
		return false;
	});

	jQuery('.chocorocco_list_icons span').on('click', function(e) {
		var list = jQuery(this).parent().fadeOut();
		var input = jQuery('#'+list.data('input_id'));
		var selector = input.next();
		var icon = chocorocco_alltrim(jQuery(this).attr('class').replace(/chocorocco_list_active/, ''));
		var bg = jQuery(this).css('background-image');
		if (bg && bg!='none') icon = 'image-'+icon;
		input.val(chocorocco_chg_icon_class(input.val(), icon)).trigger('change');
		selector.attr('class', chocorocco_chg_icon_class(selector.attr('class'), icon));
		if (bg && bg!='none') selector.css('background-image', bg);
		e.preventDefault();
		return false;
	});

	function chocorocco_chg_icon_class(classes, icon) {
		var chg = false;
		classes = chocorocco_alltrim(classes).split(' ');
		icon = icon.split('-');
		for (var i=0; i<classes.length; i++) {
			if (classes[i].indexOf(icon[0]+'-') >= 0) {
				classes[i] = icon.join('-');
				chg = true;
				break;
			}
		}
		if (!chg) {
			if (classes.length == 1 && classes[0] == '')
				classes[0] = icon.join('-');
			else
				classes.push(icon.join('-'));
		}
		return classes.join(' ');
	}

	function chocorocco_get_icon_class(classes) {
		var classes = chocorocco_alltrim(classes).split(' ');
		var icon = '';
		for (var i=0; i<classes.length; i++) {
			if (classes[i].indexOf('icon-') >= 0) {
				icon = classes[i];
				break;
			} else if (classes[i].indexOf('image-') >= 0) {
				icon = classes[i];
				break;
			}
		}
		return icon;
	}




		
	// Init checklist
	jQuery('.chocorocco_checklist:not(.inited)').addClass('inited')
		.on('change', 'input[type="checkbox"]', function() {
			var choices = '';
			var cont = jQuery(this).parents('.chocorocco_checklist');
			cont.find('input[type="checkbox"]').each(function() {
				choices += (choices ? '|' : '') + jQuery(this).data('name') + '=' + (jQuery(this).get(0).checked ? jQuery(this).val() : '0');
			});
			cont.siblings('input[type="hidden"]').eq(0).val(choices).trigger('change');
		})
		.each(function() {
			if (jQuery.ui.sortable && jQuery(this).hasClass('chocorocco_sortable')) {
				var id = jQuery(this).attr('id');
				if (id === undefined)
					jQuery(this).attr('id', 'chocorocco_sortable_'+(''+Math.random()).replace('.', ''));
				jQuery(this).sortable({
					items: ".chocorocco_sortable_item",
					placeholder: ' chocorocco_checklist_item_label chocorocco_sortable_item chocorocco_sortable_placeholder',
					update: function(event, ui) {
						var choices = '';
						ui.item.parent().find('input[type="checkbox"]').each(function() {
							choices += (choices ? '|' : '') 
									+ jQuery(this).data('name') + '=' + (jQuery(this).get(0).checked ? jQuery(this).val() : '0');
						});
						ui.item.parent().siblings('input[type="hidden"]').eq(0).val(choices).trigger('change');
					}
				})
				.disableSelection();
			}
		});




	// Standard WP Color Picker
	if (jQuery('.chocorocco_color_selector').length > 0) {
		jQuery('.chocorocco_color_selector').wpColorPicker({
			// you can declare a default color here,
			// or in the data-default-color attribute on the input
			//defaultColor: false,
	
			// a callback to fire whenever the color changes to a valid color
			change: function(e, ui){
				jQuery(e.target).val(ui.color).trigger('change');
			},
	
			// a callback to fire when the input is emptied or an invalid color
			clear: function(e) {
				jQuery(e.target).prev().trigger('change')
			},
	
			// hide the color picker controls on load
			//hide: true,
	
			// show a group of common colors beneath the square
			// or, supply an array of colors to customize further
			//palettes: true
		});
	}




	// Media selector
	CHOCOROCCO_STORAGE['media_id'] = '';
	CHOCOROCCO_STORAGE['media_frame'] = [];
	CHOCOROCCO_STORAGE['media_link'] = [];
	jQuery('.chocorocco_media_selector').on('click', function(e) {
		chocorocco_show_media_manager(this);
		e.preventDefault();
		return false;
	});
	jQuery('.chocorocco_meta_box_field_preview').on('click', '> span', function(e) {
		var image = jQuery(this);
		var button = image.parent().prev('.chocorocco_media_selector');
		var field = jQuery('#'+button.data('linked-field'));
		if (field.length == 0) return;
		if (button.data('multiple')==1) {
			var val = field.val().split('|');
			val.splice(image.index(), 1);
			field.val(val.join('|'));
			image.remove();
		} else {
			field.val('');
			image.remove();
		}
		e.preventDefault();
		return false;
	});

	function chocorocco_show_media_manager(el) {
		CHOCOROCCO_STORAGE['media_id'] = jQuery(el).attr('id');
		CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']] = jQuery(el);
		// If the media frame already exists, reopen it.
		if ( CHOCOROCCO_STORAGE['media_frame'][CHOCOROCCO_STORAGE['media_id']] ) {
			CHOCOROCCO_STORAGE['media_frame'][CHOCOROCCO_STORAGE['media_id']].open();
			return false;
		}
		var type = CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']].data('type') 
						? CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']].data('type') 
						: 'image';
		var args = {
			// Set the title of the modal.
			title: CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']].data('choose'),
			// Multiple choise
			multiple: CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']].data('multiple')==1 
						? 'add' 
						: false,
			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']].data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: true
			}
		};
		// Allow sizes and filters for the images
		if (type == 'image') {
			args['frame'] = 'post';
		}
		// Tell the modal to show only selected post types
		if (type == 'image' || type == 'audio' || type == 'video') {
			args['library'] = {
				type: type
			};
		}
		CHOCOROCCO_STORAGE['media_frame'][CHOCOROCCO_STORAGE['media_id']] = wp.media(args);

		// When an image is selected, run a callback.
		CHOCOROCCO_STORAGE['media_frame'][CHOCOROCCO_STORAGE['media_id']].on( 'insert select', function(selection) {
			// Grab the selected attachment.
			var field = jQuery("#"+CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']].data('linked-field')).eq(0);
			var attachment = null, attachment_url = '';
			if (CHOCOROCCO_STORAGE['media_link'][CHOCOROCCO_STORAGE['media_id']].data('multiple')===1) {
				CHOCOROCCO_STORAGE['media_frame'][CHOCOROCCO_STORAGE['media_id']].state().get('selection').map( function( att ) {
					attachment_url += (attachment_url ? "|" : "") + att.toJSON().url;
				});
				var val = field.val();
				attachment_url = val + (val ? "|" : '') + attachment_url;
			} else {
				attachment = CHOCOROCCO_STORAGE['media_frame'][CHOCOROCCO_STORAGE['media_id']].state().get('selection').first().toJSON();
				attachment_url = attachment.url;
				var sizes_selector = jQuery('.media-modal-content .attachment-display-settings select.size');
				if (sizes_selector.length > 0) {
					var size = chocorocco_get_listbox_selected_value(sizes_selector.get(0));
					if (size != '') attachment_url = attachment.sizes[size].url;
				}
			}
			// Display images in the preview area
			var preview = field.siblings('.chocorocco_meta_box_field_preview');
			if (preview.length == 0) {
				jQuery('<span class="chocorocco_meta_box_field_preview"></span>').insertAfter(field);
				preview = field.siblings('.chocorocco_meta_box_field_preview');
			}
			if (preview.length != 0) preview.empty();
			var images = attachment_url.split("|");
			for (var i=0; i<images.length; i++) {
				if (preview.length != 0) {
					var ext = chocorocco_get_file_ext(images[i]);
					preview.append('<span>'
									+ (ext=='gif' || ext=='jpg' || ext=='jpeg' || ext=='png' 
											? '<img src="'+images[i]+'">'
											: '<a href="'+images[i]+'">'+chocorocco_get_file_name(images[i])+'</a>'
										)
									+ '</span>');
				}
			}
			// Update field
			field.val(attachment_url).trigger('change');
		});

		// Finally, open the modal.
		CHOCOROCCO_STORAGE['media_frame'][CHOCOROCCO_STORAGE['media_id']].open();
		return false;
	}

});