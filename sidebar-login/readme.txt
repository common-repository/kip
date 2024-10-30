=== KIP ===
Contributors: Hendrawan Kuncoro, Dheche
Donate link: http://www.malang.linux.or.id
Tags: kip, public information, registration form, qa form
Requires at least: 3.5
Tested up to: 3.5.1
Stable tag: 1.7
License: GPLv2 or later

A Provider plugin for Public Information Management.

== Description ==

__Attention:__ Custom Contact Forms really needs support from developers. We need code contribution to make this plugin better.

Easily manage users and questions, by provide registration form, and ask question form, also display list of QA on your site.

Special Features:
------------------

*	__NEW__ Rearrange fields with a drag-and-drop interface
*	__NEW__ - Date field that when click displays a stylish calender popover
*	All form submissions saved and displayed in admin panel as well as emailed to you
*	Error messages can be customized for each field
*	Choose between XHTML or HTML. All code is clean and valid!
*	Create __unlimited__ fields
*	Required Fields
*	Create text fields, textareas, checkboxs, and dropdown fields!
*	__Displays forms in theme files__ as well as pages and posts.
*	Customize every aspect of fields and forms: titles, labels, maxlength, initial value, form action, form method, form style, and much more
*	Create checkboxes, textareas, text fields, etc.
*	You can create unlimited styles to use on as many forms as you want without any knowledge of css or html.
*	Show a stylish JQuery form thank you message or use a custom thank you page.
*	Custom error pages for when forms are filled out incorrectly
*	Option to have forms remember field values for when users hit the back button after an error
*	Script in constant development - new version released every week
*	Set a __custom thank you page__ for each form or use the built in thank you page popover with a custom thank you message
*	No javascript required
*	Manage options for your dropdowns and radio fields in an easy to use manager
*	Popover forms with Jquery (Coming soon!)
*	Free unlimited support
*	Assign different CSS classes to each field.
*	Ability to disable JQuery if it is conflicting with other plugins.
*	Uses UTF8 character set so non-english characters are easily used!

Restrictions/Requirements:
-------------------------
*	Works with Wordpress 3.0+
*	PHP register_globals and safe_mode should be set to "Off" (this is done in your php.ini file)
*	Your theme must call wp_head() and wp_footer()

== Installation ==
1. Upload to /wp-content/plugins
2. Activate the plugin from your Wordpress Admin Panel
3. Configure the plugin, create fields in the Settings page with prefix [KIP]
4. Display those forms in posts and pages by inserting the code: __[custom form=registration]__ __[custom form=question]__ __[custom_qa_publish]__

== Configuring and Using the Plugin ==
1. Create fields and attach those fields to the forms of your choice. Attach the fields in the order that you want them to show up in the form. If you mess up you can detach and reattach them.
2. Display those forms in posts and pages by inserting the code: __[custom form=registration]__ __[custom form=question]__.
3. (advanced) If you are confident in your HTML and CSS skills, you can use the Custom HTML Forms feature as a framework and write your forms from scratch. This allows you to use this plugin simply to process your form requests. The Custom HTML Forms feature will process and email any form variables sent to it regardless of whether they are created in the fields manager.

KIP is an extremely intuitive plugin allowing you to create any type of contact form you can image. KIP is very user friendly but with possibilities comes complexity. __It is recommend that you click the button in the instructions section of the plugin to add default fields, field options, and forms.__ The default content will help you get a feel for the amazing things you can accomplish with this plugin. __It is also recommended you click the "Show Plugin Usage Popover"__ in the instruction area of the admin page to read in detail about all parts of the plugin.

== Support ==
For questions, feature requests, and support concerning the KIP plugin, please visit:
http://hendrawankuncoro.wordpress.com

== Frequently Asked Questions ==

= Something isn't working. Help! =
*	First try deactivating and reactivating the plugin
* 	If that doesn't fix the problem, try deleting and reinstalling the plugin
*	If that doesn't work, you should file a bug report.

== Upgrade Notice ==
We are planning to add popover forms and file attachments soon.

== Screenshots ==
1. KIP Settings
2. Dashboard Widget

== Changelog ==
= 1.7 =
*  Cara memperoleh informasi (Lihat di web ; Kirim hardcopy/Softcopy ; Diambil hardcopy/softcopy) untuk pengaju pertanyaan
*  hapus beberapa widget dari dashboard
*  tambahkan widget daftar pengguna pending (bagi admin/ppid) di dashboard
*  tambahkan widget feed aggregator unt url ini: http://www.airputih.or.id/feed
*  ganti welcome page default wp

= 1.6 =
*  Upload Screenshot Images

= 1.5 =
*  Restrukturisasi Menu
*  Add Screenshots

= 1.4 =
*  Email From Name : KIP
*  Remember field value
*  Info di bawah form pendaftaran
*  Pesan Sukses setelah berhasil mengirim data pendaftaran
*  email pemberitahuan ttg user baru ke admin : link =  menu "daftar pengguna pending"

= 1.3 =
*  remove button delete user (security reason)
*  Bugfix daftar pertanyaan yang tidak bisa dilihat PPID
*  Popup konfirmasi setelah mengirim pertanyaan
*  Tanya Jawab menjadi = Status Permohonan Informasi
   - Menampilkan semua pertanyaan yang dijawab maupun ditolak
*  Cara Memperoleh Informasi (Lihat di web ; Kirim hardcopy/Softcopy ; Diambil hardcopy/softcopy)
*  Alasan penolakan
*  Enhancement UI, New Question di Dashboard dan Form KIP

= 1.2 =
*  if usertype=subscriber then after login redirect user to dashboard > KIP > Data Saya
*  if usertype=ppid then after login redirect user to dashboard > KIP > Pertanyaan Belum Terjawab
*  Link ke menu pendaftaran di bawah form login
*  View tanda pengenal -> lightbox
*  Setting Email
-  phpmail
-  smtp
-  smtp to gmail

*  Daftar user kip (subscriber) dan ppid
*  widget unt mengajukan pertanyaan baru
*  notifikasi via email ppid bila ada user baru terdaftar
*  notifikasi via email ke penanya bila pertanyaannya dijawab/ditolak

= 1.0.0.1 =
*  Add Plugin Icon
*  2 columns css
*  Add Default field for registration

= 1.0.0.0 =
*	Plugin Release
