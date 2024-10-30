<?php
/*
   Plugin Name: KIP
   Plugin URI: http://wordpress.org/extend/plugins/kip/
   Description: KIP Registrasi dan Tanya Jawab based on Taylor Lovett's Custum Contact Forms
   Version: 2.2
   Author: Hendrawan Kuncoro
   Author URI: http://hendrawankuncoro.wordpress.com
*/

/*
   Copyright (C) 2012-2013 Hendrawan Kuncoro, hendrawankuncoro.wordpress.com (hendrawan@kuncoro.com)
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 3 of the License, or
   (at your option) any later version.
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

load_plugin_textdomain( 'custom-contact-forms', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

require_once('custom-contact-forms-utils.php');
new ccf_utils();


ccf_utils::load_module('db/custom-contact-forms-db.php');
if (!class_exists('CustomContactForms')) {
   class CustomContactForms extends CustomContactFormsDB {
      var $adminOptionsName = 'customContactFormsAdminOptions';

      function activatePlugin() {
         $admin_options = $this->getAdminOptions();
         $admin_options['show_install_popover'] = 0;
         update_option($this->getAdminOptionsName(), $admin_options);
         ccf_utils::load_module('db/custom-contact-forms-activate-db.php');
         new CustomContactFormsActivateDB();

         //create default fields
         /**
          * registration :
          * username
          * question
          * subject
          * user_id
          */

         if (!parent::selectField(null, 'username')) {
            $field = array(
                  'field_slug' => 'username',
                  'field_label' => 'Username',
                  'field_type'   => 'Text',
                  'field_required' => 1
                  );
            $idFieldUsername = parent::insertField($field);
         }

         if (!parent::selectField(null, 'namalengkap')) {
            $field = array(
                  'field_slug' => 'namalengkap',
                  'field_label' => 'Nama Lengkap',
                  'field_type'   => 'Text',
                  'field_required' => 1
            );
            $idFieldNamaLengkap = parent::insertField($field);
         }

         if (!parent::selectField(null, 'telp')) {
            $field = array(
                  'field_slug' => 'telp',
                  'field_label' => 'Telp/HP',
                  'field_type'   => 'Text',
                  'field_required' => 1
            );
            $idFieldTelp = parent::insertField($field);
         }

         if (!parent::selectField(null, 'tempatlahir')) {
            $field = array(
                  'field_slug' => 'tempatlahir',
                  'field_label' => 'Tempat Lahir',
                  'field_type'   => 'Text',
                  'field_required' => 1
            );
            $idFieldTempatLahir = parent::insertField($field);
         }

         if (!parent::selectField(null, 'tgllahir')) {
            $field = array(
                  'field_slug' => 'tgllahir',
                  'field_label' => 'Tanggal Lahir',
                  'field_type'   => 'Date',
                  'field_required' => 1
            );
            $idFieldTglLahir = parent::insertField($field);
         }

         if (!parent::selectField(null, 'alamat')) {
            $field = array(
                  'field_slug' => 'alamat',
                  'field_label' => 'Alamat',
                  'field_type'   => 'Textarea',
                  'field_required' => 1
            );
            $idFieldAlamat = parent::insertField($field);
         }


         if (!parent::selectField(null, 'fax')) {
            $field = array(
                  'field_slug' => 'fax',
                  'field_label' => 'Fax',
                  'field_type'   => 'Text',
                  'field_required' => 0
            );
            $idFieldFax = parent::insertField($field);
         }

         if (!parent::selectFieldOption(null, 'ktp')) {
            $fieldOption = array(
                  'option_slug' => 'ktp',
                  'option_label' => 'KTP',
                  'option_value'   => 'KTP',
                  'option_dead' => 0
            );
            $idFieldOptKtp = parent::insertFieldOption($fieldOption);
         }

         if (!parent::selectFieldOption(null, 'sim')) {
            $fieldOption = array(
                  'option_slug' => 'sim',
                  'option_label' => 'SIM',
                  'option_value'   => 'SIM',
                  'option_dead' => 0
            );
            $idFieldOptSim = parent::insertFieldOption($fieldOption);
         }

         if (!parent::selectFieldOption(null, 'paspor')) {
            $fieldOption = array(
                  'option_slug' => 'paspor',
                  'option_label' => 'Paspor',
                  'option_value'   => 'Paspor',
                  'option_dead' => 0
            );
            $idFieldOptPaspor = parent::insertFieldOption($fieldOption);
         }


         if (!parent::selectField(null, 'tandapengenal')) {
            $field = array(
                  'field_slug' => 'tandapengenal',
                  'field_label' => 'Tanda Pengenal',
                  'field_type'   => 'Dropdown',
                  'field_required' => 1,
                  'field_options'   =>serialize(array(
                           $idFieldOptKtp,
                           $idFieldOptSim,
                           $idFieldOptPaspor
                        ))
            );
            $idFieldJnsPengenal = parent::insertField($field);
         }

         if (!parent::selectField(null, 'nopengenal')) {
            $field = array(
                  'field_slug' => 'nopengenal',
                  'field_label' => 'Nomor Tanda Pengenal',
                  'field_type'   => 'Text',
                  'field_required' => 1
            );
            $idFieldNoPengenal = parent::insertField($field);
         }

         if (!parent::selectField(null, 'uploadpengenal')) {
            $field = array(
                  'field_slug' => 'uploadpengenal',
                  'field_label' => 'Unggah Tanda Pengenal',
                  'field_type'   => 'File',
                  'field_required' => 1,
                  'field_max_upload_size'   => 5000
            );
            $idFieldUploadPengenal = parent::insertField($field);
         }



         if (!parent::selectField(null, 'user_id')) {
            $field = array(
                  'field_slug' => 'user_id',
                  'field_label' => 'User ID',
                  'field_type'   => 'Hidden',
                  'field_required' => 0
            );
            $idFieldUserId = parent::insertField($field);
         }

         if (!parent::selectField(null, 'question')) {
            $field = array(
                  'field_slug' => 'question',
                  'field_label' => 'Pertanyaan',
                  'field_type'   => 'Textarea',
                  'field_required' => 1
            );
            $idFieldQuestion = parent::insertField($field);
         }

         if (!parent::selectField(null, 'subject')) {
            $field = array(
                  'field_slug' => 'subject',
                  'field_label' => 'Subyek',
                  'field_type'   => 'Text',
                  'field_required' => 1
            );
            $idFieldSubject = parent::insertField($field);
         }

         if (!parent::selectFieldOption(null, 'lihat_web')) {
            $fieldOption = array(
                  'option_slug' => 'lihat_web',
                  'option_label' => 'Lihat di Web',
                  'option_value'   => 'Lihat di Web',
                  'option_dead' => 0
            );
            $idFieldOptLihatWeb = parent::insertFieldOption($fieldOption);
         }

         if (!parent::selectFieldOption(null, 'kirim_copy')) {
            $fieldOption = array(
                  'option_slug' => 'kirim_copy',
                  'option_label' => 'Kirim Hardcopy/Softcopy',
                  'option_value'   => 'Kirim Hardcopy/Softcopy',
                  'option_dead' => 0
            );
            $idFieldOptKirim = parent::insertFieldOption($fieldOption);
         }

         if (!parent::selectFieldOption(null, 'ambil_copy')) {
            $fieldOption = array(
                  'option_slug' => 'ambil_copy',
                  'option_label' => 'Diambil Hardcopy/Softcopy',
                  'option_value'   => 'Diambil Hardcopy/Softcopy',
                  'option_dead' => 0
            );
            $idFieldOptAmbil = parent::insertFieldOption($fieldOption);
         }

         if (!parent::selectField(null, 'source')) {
            $field = array(
                  'field_slug' => 'source',
                  'field_label' => 'Cara Memperoleh Informasi',
                  'field_type'   => 'Dropdown',
                  'field_required' => 1,
                  'field_options'   =>serialize(array(
                           $idFieldOptLihatWeb,
                           $idFieldOptKirim,
                           $idFieldOptAmbil
                        ))
            );
            $idFieldSource = parent::insertField($field);
         }

         if (!parent::selectField(null, 'reason')) {
            $field = array(
                  'field_slug' => 'reason',
                  'field_label' => 'Alasan Permintaan Informasi',
                  'field_type'   => 'Textarea',
                  'field_required' => 1
            );
            $idFieldReason = parent::insertField($field);
         }

         if (!parent::selectField(null, 'purpose')) {
            $field = array(
                  'field_slug' => 'purpose',
                  'field_label' => 'Tujuan Penggunaan Informasi',
                  'field_type'   => 'Textarea',
                  'field_required' => 1
            );
            $idFieldPurpose = parent::insertField($field);
         }

         $fixedEmailField = parent::selectField(null, 'fixedEmail');

         //add form
         //create form registration
         if (!parent::selectForm(null, 'registration')) {
            $form = array(
                  'form_slug' => 'registration',
                  'form_access'   => array(
                        'Non-Registered User'),
                  'form_method'   => 'Post',
                  'form_fields' => serialize(array(
                        $idFieldUsername,
                        (integer) $fixedEmailField->id,
                        $idFieldNamaLengkap,
                        $idFieldTelp,
                        $idFieldTempatLahir,
                        $idFieldTglLahir,
                        $idFieldAlamat,
                        $idFieldFax,
                        $idFieldJnsPengenal,
                        $idFieldNoPengenal,
                        $idFieldUploadPengenal,
                        )),
                  'submit_button_text' => 'Daftar',
                  'form_success_message' => 'Data pendaftaran Anda telah kami simpan. Silakan tunggu email dari administrator.',
                  'form_success_title' => 'Sukses',
            );
            $idFormRegistration = parent::insertForm($form);
         } else {
            global $wpdb;
            $formR = parent::selectForm(null, 'registration');
            $wpdb->update(CCF_FORMS_TABLE, array('form_success_message' => 'Data pendaftaran Anda telah kami simpan. Silakan tunggu email dari administrator.',
                  'form_success_title' => 'Sukses',), array('id' => $formR->id));
         }

         //create form QA
         if (!parent::selectForm(null, 'question')) {
            $form = array(
                  'form_slug' => 'question',
                  'form_access'   => array(
                        'Administrator',
                        'Editor',
                        'Author',
                        'Contributor',
                        'Subscriber',
                        ),
                  'form_method'   => 'Post',
                  'form_fields' => serialize(array(
                        $idFieldSubject,
                        $idFieldQuestion,
                        $idFieldReason,
                        $idFieldPurpose,
                        $idFieldSource,
                        $idFieldUserId
                  )),
                  'submit_button_text' => 'kirim',
                  'form_success_message' => 'Pertanyaan anda berhasil tersimpan, Admin akan segera menanggapi',
                  'form_success_title' => 'Sukses',
            );
            $idFormQA = parent::insertForm($form);
         } else {
            global $wpdb;
            $formQA = parent::selectForm(null, 'question');

            $idFieldSubject = parent::selectField(null, 'subject')->id;
            $idFieldQuestion = parent::selectField(null, 'question')->id;
            $idFieldReason = parent::selectField(null, 'reason')->id;
            $idFieldPurpose = parent::selectField(null, 'purpose')->id;
            $idFieldSource = parent::selectField(null, 'source')->id;
            $idFieldUserId = parent::selectField(null, 'user_id')->id;

            if (isset($idFieldSource) && $idFieldSource)
            $wpdb->update(CCF_FORMS_TABLE, array('form_fields' => serialize(array(
                        $idFieldSubject,
                        $idFieldQuestion,
                        $idFieldReason,
                        $idFieldPurpose,
                        $idFieldSource,
                        $idFieldUserId
                  ))
                  ), array('id' => $formQA->id));

            $wpdb->update(CCF_FORMS_TABLE, array('form_success_message' => 'Pertanyaan anda berhasil tersimpan, Admin akan segera menanggapi',
                  'form_success_title' => 'Sukses',), array('id' => $formQA->id));
         }

         //create pages
         $args = array(
               'sort_order' => 'ASC',
               'sort_column' => 'post_title',
               'hierarchical' => 1,
               'exclude' => '',
               'include' => '',
               'meta_key' => '',
               'meta_value' => '',
               'authors' => '',
               'child_of' => 0,
               'parent' => -1,
               'exclude_tree' => '',
               'number' => '',
               'offset' => 0,
               'post_type' => 'page',
               'post_status' => 'publish'
         );

         $pages = get_pages( $args );
         $isRegPageExist = false;
         $isQPageExist = false;
         $isQAPageExist = false;

         foreach ($pages as $page) {
            if (strpos($page->post_content, "[custom_qa_publish]") !== FALSE)
               $isQAPageExist = $page->ID;
            if (strpos($page->post_content, "[custom form=registration]") !== FALSE)
               $isRegPageExist = true;
            if (strpos($page->post_content, "[custom form=question]") !== FALSE)
               $isQPageExist = true;
         }

         if (!$isRegPageExist) {
            $post = array(
                  'post_title'    => 'Pendaftaran',
                  'post_content'  => '[custom form=registration]',
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'post_type'     => 'page',
                  'comment_status' => 'closed'
            );
            //create page registration
            wp_insert_post( $post);
         }

         if (!$isQPageExist) {
            $post = array(
                  'post_title'    => 'Pertanyaan',
                  'post_content'  => '[custom form=question]',
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'post_type'     => 'page',
                  'comment_status' => 'closed'
            );
            //create page question
//             wp_insert_post( $post);
         }

         if (!$isQAPageExist) {
            $post = array(
                  'post_title'    => 'Status Permohonan Informasi',
                  'post_content'  => '[custom_qa_publish]',
                  'post_status'   => 'publish',
                  'post_author'   => 1,
                  'post_type'     => 'page',
                  'comment_status' => 'closed'
            );
            //create page qa
            wp_insert_post( $post);
         } else {
            $my_post = array();
            $my_post['ID'] = $isQAPageExist;
            $my_post['post_title'] = 'Status Permohonan Informasi';
            $my_post['post_content'] = '[custom_qa_publish]';

            wp_update_post($my_post);
         }

         //insert default user

         //ROLES
         if (!get_role( 'ppid' )) {
            add_role( 'ppid', 'Pejabat PID', array(
               'delete_others_pages' => true,
               'delete_others_posts' => true,
               'delete_pages' => true,
               'delete_posts' => true,
               'delete_private_pages' => true,
               'delete_private_posts' => true,
               'delete_published_pages' => true,
               'delete_published_posts' => true,
               'edit_others_pages' => true,
               'edit_others_posts' => true,
               'edit_pages' => true,
               'edit_posts' => true,
               'edit_private_pages' => true,
               'edit_private_posts' => true,
               'edit_published_pages' => true,
               'edit_published_posts' => true,
               'manage_categories' => true,
               'manage_links' => true,
               'moderate_comments' => true,
               'publish_pages' => true,
               'publish_posts' => true,
               'read' => true,
               'read_private_pages' => true,
               'unfiltered_html' => true,
               'upload_files' => true,
            ) );
         } else {
            global $wp_roles;
            $names = $wp_roles->get_names();
            if (isset($names['ppid']) && $names['ppid'] != 'Pejabat PID') {
               add_role( 'ppid', 'Pejabat PID', array(
               'delete_others_pages' => true,
               'delete_others_posts' => true,
               'delete_pages' => true,
               'delete_posts' => true,
               'delete_private_pages' => true,
               'delete_private_posts' => true,
               'delete_published_pages' => true,
               'delete_published_posts' => true,
               'edit_others_pages' => true,
               'edit_others_posts' => true,
               'edit_pages' => true,
               'edit_posts' => true,
               'edit_private_pages' => true,
               'edit_private_posts' => true,
               'edit_published_pages' => true,
               'edit_published_posts' => true,
               'manage_categories' => true,
               'manage_links' => true,
               'moderate_comments' => true,
               'publish_pages' => true,
               'publish_posts' => true,
               'read' => true,
               'read_private_pages' => true,
               'unfiltered_html' => true,
               'upload_files' => true,
               ) );
            }
         }

         if (!get_role( 'applicant' )) {
            add_role( 'applicant', 'Pemohon Informasi', array(
               'read' => true,
            ) );
         }

      }

      function getAdminOptionsName() {
         return $this->adminOptionsName;
      }

      function getAdminOptions() {
         $admin_email = get_option('admin_email');
         $customcontactAdminOptions = array (
               'show_widget_home' => 1,
               'show_widget_pages' => 1,
               'show_widget_singles' => 1,
               'show_widget_categories' => 1,
               'show_widget_archives' => 1,
               'default_to_email' => $admin_email,
               'default_from_email' => $admin_email,
               'default_from_name' => 'KIP',
               'default_form_subject' => __ ( 'Someone Filled Out Your Contact Form!', 'custom-contact-forms' ),
               'remember_field_values' => 1,
               'enable_widget_tooltips' => 1,
               'mail_function' => 'default',
               'form_success_message_title' => __ ( 'Successful Form Submission', 'custom-contact-forms' ),
               'form_success_message' => __ ( 'Thank you for filling out our web form. We will get back to you ASAP.', 'custom-contact-forms' ),
               'enable_jquery' => 1,
               'code_type' => 'XHTML',
               'show_install_popover' => 0,
               'email_form_submissions' => 1,
               'enable_dashboard_widget' => 1,
               'admin_ajax' => 1,
               'smtp_host' => '',
               'smtp_encryption' => 'none',
               'smtp_authentication' => 0,
               'smtp_username' => '',
               'smtp_password' => '',
               'smtp_port' => '',
               'enable_form_access_manager' => 1,
               'default_form_error_header' => __ ( 'Periksa kembali isian anda.', 'custom-contact-forms' ),
               'default_form_bad_permissions' => __("You don't have the proper permissions to view this form.", 'custom-contact-forms'), 'enable_form_access_manager' => 0, 'dashboard_access' => 2, 'form_page_inclusion_only' => 0, 'max_file_upload_size' => 10, 'recaptcha_public_key' => '', 'recaptcha_private_key' => '' ); // default general settings
         $customcontactOptions = get_option($this->getAdminOptionsName());
         if (!empty($customcontactOptions)) {
            foreach ($customcontactOptions as $key => $option)
               $customcontactAdminOptions[$key] = $option;
         }
         $customcontactAdminOptions['enable_form_access_manager'] = 1;
         $customcontactAdminOptions['remember_field_values'] = 1;
         $customcontactAdminOptions['default_form_error_header'] = __ ( 'Periksa kembali isian anda.', 'custom-contact-forms' );
         update_option($this->getAdminOptionsName(), $customcontactAdminOptions);
         return $customcontactAdminOptions;
      }

      function langHandle() {
         if (function_exists('load_plugin_textdomain')) {
            load_plugin_textdomain('custom-contact-forms', false, dirname(plugin_basename(__FILE__)) . '/lang');
         }
      }
   }
}

function question_add_dashboard_widgets_function() {
   ?>
<style>
#example_dashboard_widget .input-text-wrap,#example_dashboard_widget .textarea-wrap
   {
   margin: 0 0 1em;
}

#example_dashboard_widget .input-text-wrap {
   position: relative;
}

#example_dashboard_widget .prompt {
   color: #BBBBBB;
   position: absolute;
}
</style>
<script>
jQuery(document).ready(function() {
   jQuery("#ccf-text, #ccf-textarea").each(function(){
      var h=jQuery(this),g=jQuery(this).prev();
      if(""===this.value){
          g.removeClass("screen-reader-text")
       }g.click(function(){
          jQuery(this).addClass("screen-reader-text");h.focus()});h.blur(function(){if(""===this.value){g.removeClass("screen-reader-text")}});h.focus(function(){g.addClass("screen-reader-text")})});
});
   </script>
<?php
   // Display whatever it is you want to show
   echo do_shortcode("[custom form=question_dashboard]");
   echo  "<br/>";
}

function question_add_dashboard_widgets_userpending_function() {
   $cAdmin = new CustomContactFormsAdmin();
   $cAdmin->pendingUsersPageWidget();

}
function question_add_dashboard_widgets_qpending_function() {
   $cAdmin = new CustomContactFormsAdmin();
   $cAdmin->pendingQuestionsPageWidget();

}

function question_add_dashboard_widgets_feed_function() {
   $widgets = get_option( 'dashboard_widget_options' );
   @extract( @$widgets['example_dashboard_widget_feed'], EXTR_SKIP );
   $rss = @fetch_feed( $url );

   if ( is_wp_error($rss) ) {
      if ( is_admin() || current_user_can('manage_options') ) {
         echo '<div class="rss-widget"><p>';
         printf(__('<strong>RSS Error</strong>: %s'), $rss->get_error_message());
         echo '</p></div>';
      }
   } elseif ( !$rss->get_item_quantity() ) {
      $rss->__destruct();
      unset($rss);
      return false;
   } else {
      echo '<div class="rss-widget">';
      wp_widget_rss_output( $rss, $widgets['example_dashboard_widget_feed'] );
      echo '</div>';
      $rss->__destruct();
      unset($rss);
   }
}

function question_add_dashboard_widgets_feed_control() {
   wp_dashboard_rss_control( 'example_dashboard_widget_feed' );
}
function question_add_dashboard_widgets() {
   wp_add_dashboard_widget('example_dashboard_widget', 'Formulir Permohonan Informasi Publik', 'question_add_dashboard_widgets_function');

   $widget_options = get_option( 'dashboard_widget_options' );
   if ( !isset( $widget_options['example_dashboard_widget_feed'] ) ) {
      $update = true;
      $widget_options['example_dashboard_widget_feed'] = array(
            'link' => apply_filters( 'dashboard_secondary_link', __( 'http://www.airputih.or.id' ) ),
            'url' => apply_filters( 'dashboard_secondary_link', __( 'http://www.airputih.or.id/feed' ) ),
            'title' => apply_filters( 'dashboard_secondary_link', __( 'Berita' ) ),
            'items' => 5,
            'show_summary' => 1,
            'show_author' => 1,
            'show_date' => 1,
      );
   }
   if ( $update )
      update_option( 'dashboard_widget_options', $widget_options );

   wp_add_dashboard_widget('example_dashboard_widget_feed', $widget_options['example_dashboard_widget_feed']['title'], 'question_add_dashboard_widgets_feed_function', 'question_add_dashboard_widgets_feed_control');


   // Globalize the metaboxes array, this holds all the widgets for wp-admin

   global $wp_meta_boxes;

   // Get the regular dashboard widgets array
   // (which has our new widget already but at the end)

   $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

   // Backup and delete our new dashboard widget from the end of the array

   $example_widget_backup = array('example_dashboard_widget' => $normal_dashboard['example_dashboard_widget'], 'example_dashboard_widget_feed' => $normal_dashboard['example_dashboard_widget_feed']);
   if (is_super_admin() || current_user_can('publish_pages')) {
      unset($normal_dashboard['example_dashboard_widget']);
      unset($normal_dashboard['example_dashboard_widget_feed']);
      // Merge the two arrays together so our widget is at the beginning

      $sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);
      $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
   } else {
      unset($normal_dashboard['example_dashboard_widget']);
      unset($normal_dashboard['example_dashboard_widget_feed']);


      $side_dashboard = $wp_meta_boxes['dashboard']['side']['core'];
      $side_dashboard ['example_dashboard_widget_feed']= $example_widget_backup['example_dashboard_widget_feed'];
      $wp_meta_boxes['dashboard']['side']['core'] = $side_dashboard;
      $sorted_dashboard = array_merge(array($example_widget_backup['example_dashboard_widget']), $normal_dashboard);
      $wp_meta_boxes['dashboard']['normal']['core'] = $normal_dashboard;
   }




   // Save the sorted array back into the original metaboxes

   $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
   if (is_super_admin() || current_user_can('publish_pages')) {
      wp_add_dashboard_widget('example_dashboard_widget_2', 'Pengguna Pending', 'question_add_dashboard_widgets_userpending_function');
      wp_add_dashboard_widget('example_dashboard_widget_3', 'Pertanyaan Pending', 'question_add_dashboard_widgets_qpending_function');

      $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

      $wp_meta_boxes['dashboard']['side']['core']['example_dashboard_widget_2'] = $normal_dashboard['example_dashboard_widget_2'];
      $wp_meta_boxes['dashboard']['side']['core']['example_dashboard_widget_3'] = $normal_dashboard['example_dashboard_widget_3'];

      $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_comments'] = $normal_dashboard['dashboard_recent_comments'];

      unset($normal_dashboard['example_dashboard_widget_2']);
      unset($normal_dashboard['example_dashboard_widget_3']);
      unset($normal_dashboard['dashboard_recent_comments']);

      $side_dashboard = $wp_meta_boxes['dashboard']['side']['core'];
      $backSiede = array('example_dashboard_widget_2' => $side_dashboard['example_dashboard_widget_2'], 'example_dashboard_widget_3' => $side_dashboard['example_dashboard_widget_3']);
      unset($side_dashboard['example_dashboard_widget_2']);
      unset($side_dashboard['example_dashboard_widget_3']);

      $sorted_dashboard2 = array_merge($backSiede, $side_dashboard);
      $sorted_dashboard2['dashboard_recent_comments'] = $side_dashboard['dashboard_recent_comments'];
      unset($side_dashboard['dashboard_recent_comments']);
      $wp_meta_boxes['dashboard']['side']['core'] = $sorted_dashboard2;
      $wp_meta_boxes['dashboard']['normal']['core'] = $normal_dashboard;
   } else {
//       $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
//       $side_dashboard = $wp_meta_boxes['dashboard']['side']['core'];
   }

}


add_action('admin_head-index.php', 'wpse_57350_script_enqueuer');

function wpse_57350_script_enqueuer()
{

   // Check if Welcome Panel is being displayed
   update_user_meta(get_current_user_id(), 'show_welcome_panel', true);
   $option = get_user_meta( get_current_user_id(), 'show_welcome_panel', true );
   $isAdminPpid = is_super_admin() || current_user_can('publish_pages') ? true : false;
   if( !$option )
      return;

   ?>
    <style type="text/css">
        /*
         * Hide the Welcome Panel and the "dismiss" message at the bottom
         */
        #welcome-panel {opacity:0.01;}
        p.welcome-panel-dismiss {display:none}
    </style>
    <script type="text/javascript">
    var is_admin = <?php echo $isAdminPpid ? 'true' : 'false'?>;
    jQuery(document).ready( function($)
    {
        if (!is_admin ) {
           var htmlUser = '<div class="welcome-panel" id="welcome-panel" style="opacity: 1;">'+
              '<input type="hidden" value="<?php echo wp_create_nonce() ?>" name="welcomepanelnonce" id="welcomepanelnonce"><a href="?welcome=0" class="welcome-panel-close">Dismiss</a>'+
               '<div class="welcome-panel-content">'+
         '<h3>Selamat Datang di Aplikasi Keterbukaan Informasi Publik</h3>'+
         '<p class="about-description"></p>'+
         '<div class="welcome-panel-column-container"><div class="welcome-panel-column"><h4>Menu KIP</h4><ul><li><a href="admin.php?page=custom-contact-data" class="welcome-icon welcome-widgets-menus">Biodata Pribadi</a></li><li><a href="admin.php?page=ccf-new-question" class="welcome-icon welcome-add-page">Buat Pertanyaan Baru</a></li><li><a href="admin.php?page=ccf-pending-question" class="welcome-icon welcome-comments">Pertanyaan Saya yang belum terjawab</a></li><li><a href="admin.php?page=ccf-answered-question" class="welcome-icon welcome-comments">Pertanyaan Saya yang sudah terjawab</a></li></ul></div></div>'+
         '</div>'+
            '</div>';
           $(htmlUser).insertBefore('#dashboard-widgets-wrap');
        } else {
        /*
         * Left side image and text
         * - changing CSS properties and raw Html content of the Div
         */
        $('div.wp-badge').css('color','#00a30a');
        $('div.wp-badge').html('Our Welcome screen');

        // Right side H3 (change raw Html content)
        $('div.welcome-panel-content h3').html('Selamat Datang di Aplikasi Keterbukaan Informasi Publik');

        // Right side paragraph (idem)
        $('p.about-description').html('');
        $('.welcome-panel-column-container').empty();
        var htmlAdmin = '<div class="welcome-panel-column">'+
            '<h4>Pengelolaan KIP</h4>' +
            '<ul>' +
                     '<li><a class="welcome-icon welcome-widgets-menus" href="options-general.php?page=custom-contact-forms">Kelola Form</a></li>' +
                     '<li><a class="welcome-icon welcome-widgets-menus" href="options-general.php?page=ccf-fields">Kelola Isian Form</a></li>' +
                     '<li><a class="welcome-icon welcome-widgets-menus" href="options-general.php?page=ccf-settings">Kelola KIP</a></li>' +
            '</ul>' +
         '</div>' +
         '<div class="welcome-panel-column">'+
         '<h4>Pengelolaan Pertanyaan</h4>' +
         '<ul>' +
                  '<li><a class="welcome-icon welcome-comments" href="admin.php?page=ccf-pending-question">Pertanyaan Pending</a></li>' +
                  '<li><a class="welcome-icon welcome-comments" href="admin.php?page=ccf-answered-question">Pertanyaan Terjawab</a></li>' +
         '</ul>' +
      '</div>' +
      '<div class="welcome-panel-column">'+
      '<h4>Pengelolaan Pengguna</h4>' +
      '<ul>' +
               '<li><a class="welcome-icon welcome-learn-more" href="admin.php?page=ccf-user">Pengguna Aktif</a></li>' +
               '<li><a class="welcome-icon welcome-learn-more" href="admin.php?page=ccf-pending">Pengguna Pending</a></li>' +
               '<li><a class="welcome-icon welcome-learn-more" href="admin.php?page=ccf-ppid">Pejabat PPID</a></li>' +
      '</ul>' +
   '</div>';

        var htmlPpid = '<div class="welcome-panel" id="welcome-panel" style="opacity: 1;">'+
        '<input type="hidden" value="<?php echo wp_create_nonce() ?>" name="welcomepanelnonce" id="welcomepanelnonce"><a href="?welcome=0" class="welcome-panel-close">Dismiss</a>'+
        '<div class="welcome-panel-content">'+
  '<h3>Selamat Datang di Aplikasi Keterbukaan Informasi Publik</h3>'+
  '<p class="about-description"></p>'+
  '<div class="welcome-panel-column-container">'+
'<div class="welcome-panel-column">'+
'<h4>Pengelolaan Pertanyaan</h4>' +
'<ul>' +
        '<li><a class="welcome-icon welcome-comments" href="admin.php?page=ccf-pending-question">Pertanyaan Pending</a></li>' +
        '<li><a class="welcome-icon welcome-comments" href="admin.php?page=ccf-answered-question">Pertanyaan Terjawab</a></li>' +
'</ul>' +
'</div>' +
'<div class="welcome-panel-column">'+
'<h4>Pengelolaan Pengguna</h4>' +
'<ul>' +
     '<li><a class="welcome-icon welcome-learn-more" href="admin.php?page=ccf-user">Pengguna Aktif</a></li>' +
     '<li><a class="welcome-icon welcome-learn-more" href="admin.php?page=ccf-pending">Pengguna Pending</a></li>' +
     '<li><a class="welcome-icon welcome-learn-more" href="admin.php?page=ccf-ppid">Pejabat PPID</a></li>' +
'</ul>' +
'</div>'+
  '</div>'+
     '</div>';


        if ($('.welcome-panel-column-container').length == 0)
           $(htmlPpid).insertBefore('#dashboard-widgets-wrap');
        else
           $('.welcome-panel-column-container').html(htmlAdmin);
        //$('.welcome-panel-column a').html('Menyunting Form');
        //$('.welcome-panel-column a').attr('href', 'options-general.php?page=custom-contact-forms');
        //$('.welcome-panel-column p.hide-if-no-customize').hide();

        /*
         * Everything modified, fade in the whole Div
         * The fade in effect can be removed deleting this and the CSS opacity property
         */
        }
        $('#welcome-panel').delay(300).fadeTo('slow',1);
    });
    </script>
    <?php
}


// Redirect admins to the dashboard and other users elsewhere
function my_login_redirect( $redirect_to, $request, $user ) {
   return admin_url(null, null);
}

// Redirect admins to the dashboard and other users elsewhere
function my_login_redirect_2( $redirect_to) {
      return admin_url(null, null);
}

add_filter('login_redirect', 'my_login_redirect', 10, 3);

add_filter('sidebar_login_widget_login_redirect', 'my_login_redirect_2', 10, 1);



add_action('init','possibly_redirect');

function possibly_redirect(){
   if ( strpos($_SERVER['REQUEST_URI'], 'wp-login.php?action=register')) {

      $args = array(
            'sort_order' => 'ASC',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
      );

      $pages = get_pages( $args );

      foreach ($pages as $page) {
         if (strpos($page->post_content, "[custom form=registration]") !== FALSE) {
            wp_safe_redirect( $page->guid );
            exit();
         }
      }

   }
}


$custom_contact_forms = new CustomContactForms();

/* general plugin stuff */
if (isset($custom_contact_forms)) {
   register_activation_hook(  __FILE__ , array(&$custom_contact_forms, 'activatePlugin'));
}


require_once('custom-contact-forms-front.php');
$custom_contact_front = new CustomContactFormsFront();
if (!function_exists('serveCustomContactForm')) {
   function serveCustomContactForm($fid) {
      global $custom_contact_front;
      echo $custom_contact_front->getFormCode($custom_contact_front->selectForm($fid));
   }
}
add_action('init', array(&$custom_contact_front, 'frontInit'), 1);
add_action('template_redirect', array(&$custom_contact_front, 'includeDependencies'), 1);
//add_action('wp_enqueue_scripts', array(&$custom_contact_front, 'insertFrontEndScripts'), 1);
//add_action('wp_print_styles', array(&$custom_contact_front, 'insertFrontEndStyles'), 1);
add_shortcode('custom', array(&$custom_contact_front, 'shortCodeToForm'));
add_shortcode('custom_qa_publish', array(&$custom_contact_front, 'shortCodeToDisplayPublished'));

add_filter('the_content', array(&$custom_contact_front, 'contentFilter'));


// if (!is_admin()) { /* is front */


// } else { /* is admin */
   $GLOBALS['ccf_current_page'] = (isset($_GET['page'])) ? $_GET['page'] : '';
   require_once('custom-contact-forms-admin.php');
   $custom_contact_admin = new CustomContactFormsAdmin();
   if (!function_exists('CustomContactForms_ap')) {
      function CustomContactForms_ap() {
         global $custom_contact_admin;
         if (!isset($custom_contact_admin)) return;
         add_action('wp_dashboard_setup', 'question_add_dashboard_widgets' );
         if (is_super_admin()) {
            if (function_exists('add_menu_page')) {



               add_options_page( '[KIP] Form', '[KIP] Form', 'manage_options', 'custom-contact-forms', array(&$custom_contact_admin, 'printAdminPage') );
               add_options_page( '[KIP] Isian', '[KIP] Isian', 'manage_options', 'ccf-fields', array(&$custom_contact_admin, 'printAdminFieldPage') );
               add_options_page( '[KIP] Pengaturan Umum', '[KIP] Pengaturan Umum', 'manage_options', 'ccf-settings', array(&$custom_contact_admin, 'printSettingsPageKip') );

               add_menu_page(__('KIP [Pertanyaan]', 'custom-contact-forms'), __('KIP [Pertanyaan]', 'custom-contact-forms'), 'manage_options', 'ccf-pending-question', array(&$custom_contact_admin, 'pendingQuestionsPage'), plugins_url(null, __FILE__) . '/images/comments.png');
               add_submenu_page('ccf-pending-question', __('Belum Terjawab', 'custom-contact-forms'), __('Belum Terjawab', 'custom-contact-forms'), 'manage_options', 'ccf-pending-question', array(&$custom_contact_admin, 'pendingQuestionsPage'));
               add_submenu_page('ccf-pending-question', __('Terjawab', 'custom-contact-forms'), __('Pertanyaan Terjawab', 'custom-contact-forms'), 'manage_options', 'ccf-answered-question', array(&$custom_contact_admin, 'answeredQuestionsPage'));
               add_submenu_page('ccf-pending-question', __('Pertanyaan Baru', 'custom-contact-forms'), __('Pertanyaan Baru', 'custom-contact-forms'), 'manage_options', 'ccf-new-question', array(&$custom_contact_admin, 'newQuestionsPage'));

               add_menu_page(__('KIP [Pengguna]', 'custom-contact-forms'), __('KIP [Pengguna]', 'custom-contact-forms'), 'manage_options', 'ccf-user', array(&$custom_contact_admin, 'UsersPage'), plugins_url(null, __FILE__) . '/images/users.png');
               add_submenu_page('ccf-user', __('Aktif', 'custom-contact-forms'), __('Aktif', 'custom-contact-forms'), 'manage_options', 'ccf-user', array(&$custom_contact_admin, 'UsersPage'));
               add_submenu_page('ccf-user', __('Pending', 'custom-contact-forms'), __('Pending', 'custom-contact-forms'), 'manage_options', 'ccf-pending', array(&$custom_contact_admin, 'pendingUsersPage'));
               add_submenu_page('ccf-user', __('PPID', 'custom-contact-forms'), __('PPID', 'custom-contact-forms'), 'manage_options', 'ccf-ppid', array(&$custom_contact_admin, 'PpidPage'));
            }
         } else {
            if(current_user_can('publish_pages')) {
               if (function_exists('add_menu_page')) {

                  add_menu_page(__('KIP [Pertanyaan]', 'custom-contact-forms'), __('KIP [Pertanyaan]', 'custom-contact-forms'), 'publish_pages', 'ccf-pending-question', array(&$custom_contact_admin, 'pendingQuestionsPage'), plugins_url(null, __FILE__) . '/images/comments.png');
                  add_submenu_page('ccf-pending-question', __('Belum Terjawab', 'custom-contact-forms'), __('Belum Terjawab', 'custom-contact-forms'), 'publish_pages', 'ccf-pending-question', array(&$custom_contact_admin, 'pendingQuestionsPage'));
                  add_submenu_page('ccf-pending-question', __('Terjawab', 'custom-contact-forms'), __('Pertanyaan Terjawab', 'custom-contact-forms'), 'publish_pages', 'ccf-answered-question', array(&$custom_contact_admin, 'answeredQuestionsPage'));
                  add_submenu_page('ccf-pending-question', __('Pertanyaan Baru', 'custom-contact-forms'), __('Pertanyaan Baru', 'custom-contact-forms'), 'publish_pages', 'ccf-new-question', array(&$custom_contact_admin, 'newQuestionsPage'));

                  add_menu_page(__('KIP [Pengguna]', 'custom-contact-forms'), __('KIP [Pengguna]', 'custom-contact-forms'), 'publish_pages', 'ccf-user', array(&$custom_contact_admin, 'UsersPage'), plugins_url(null, __FILE__) . '/images/users.png');
                  add_submenu_page('ccf-user', __('Aktif', 'custom-contact-forms'), __('Aktif', 'custom-contact-forms'), 'publish_pages', 'ccf-user', array(&$custom_contact_admin, 'UsersPage'));
                  add_submenu_page('ccf-user', __('Pending', 'custom-contact-forms'), __('Pending', 'custom-contact-forms'), 'publish_pages', 'ccf-pending', array(&$custom_contact_admin, 'pendingUsersPage'));
                  add_submenu_page('ccf-user', __('PPID', 'custom-contact-forms'), __('PPID', 'custom-contact-forms'), 'publish_pages', 'ccf-ppid', array(&$custom_contact_admin, 'PpidPage'));

               }
            } else {
               if (function_exists('add_menu_page')) {
                  add_menu_page(__('KIP [Data]', 'custom-contact-data'), __('KIP [Data]', 'custom-contact-data'), 'read', 'custom-contact-data', array(&$custom_contact_admin, 'printMyData'), plugins_url(null, __FILE__) . '/images/users_comments.png');
                  add_submenu_page('custom-contact-data', __('Biodata Pribadi', 'custom-contact-data'), __('Biodata Pribadi', 'custom-contact-data'), 'read', 'custom-contact-data', array(&$custom_contact_admin, 'printMyData'));
                  add_submenu_page('custom-contact-data', __('Pertanyaan Baru', 'custom-contact-data'), __('Pertanyaan Baru', 'custom-contact-data'), 'read', 'ccf-new-question', array(&$custom_contact_admin, 'newQuestionsPage'));
                  add_submenu_page('custom-contact-data', __('Pertanyaan Belum Terjawab', 'custom-contact-data'), __('Pertanyaan Belum Terjawab', 'custom-contact-data'), 'read', 'ccf-pending-question', array(&$custom_contact_admin, 'pendingQuestionsPage'));
                  add_submenu_page('custom-contact-data', __('Pertanyaan Terjawab', 'custom-contact-data'), __('Pertanyaan Terjawab', 'custom-contact-data'), 'read', 'ccf-answered-question', array(&$custom_contact_admin, 'answeredQuestionsPage'));
               }
            }

         }
      }
   }
   $admin_options = $custom_contact_admin->getAdminOptions();
//    if (isset($admin_options['enable_dashboard_widget']) && $admin_options['enable_dashboard_widget'] == 1) {
      ccf_utils::load_module('widget/custom-contact-forms-dashboard.php');
      $ccf_dashboard = new CustomContactFormsDashboard();
      if ($ccf_dashboard->isDashboardPage()) {
         add_action('admin_print_styles', array(&$ccf_dashboard, 'insertDashboardStyles2'), 1);
//          add_action('admin_enqueue_scripts', array(&$ccf_dashboard, 'insertDashboardScripts2'), 1);
      }
//       add_action('wp_dashboard_setup', array(&$ccf_dashboard, 'install'));
//    }
   add_action('init', array(&$custom_contact_admin, 'adminInit'), 1);
   if ($custom_contact_admin->isPluginAdminPage()) {
      add_action('admin_print_styles', array(&$custom_contact_admin, 'insertBackEndStyles'), 1);
      add_action('admin_enqueue_scripts', array(&$custom_contact_admin, 'insertAdminScripts'), 1);
   }
   add_action('wp_ajax_ccf-ajax', array(&$custom_contact_admin, 'handleAJAX'));
   add_action('wp_ajax_nopriv_ccf-ajax', array(&$custom_contact_admin, 'handleAJAX'));
   add_filter('plugin_action_links', array(&$custom_contact_admin,'appendToActionLinks'), 10, 2);
   add_action('admin_menu', 'CustomContactForms_ap');
// }

/* widget stuff */
ccf_utils::load_module('widget/custom-contact-forms-widget.php');
if (!function_exists('CCFWidgetInit')) {
   function CCFWidgetInit() {
      register_widget('CustomContactFormsWidget');
   }
}
add_action('widgets_init', 'CCFWidgetInit');

function remove_dashboard_widgets() {
   remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
   remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
   remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
   remove_meta_box('dashboard_primary', 'dashboard', 'normal');
   remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
}
add_action('admin_init', 'remove_dashboard_widgets' );


//ADDITIONALSSS

require_once('hide-wordpress-version.php');
require_once('sidebar-login/sidebar-login.php');
require_once('white-label-cms/wlcms-plugin.php');
