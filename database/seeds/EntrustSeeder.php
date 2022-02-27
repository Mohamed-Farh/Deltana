<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Role;
use App\User;
use Carbon\Carbon;
use Faker\Factory;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        $superAdminRole     = Role::create(['name' => 'superAdmin',  'display_name' => 'Administrator',  'description' => 'System Administrator', 'allowed_route' => 'admin']);
        $adminRole          = Role::create(['name' => 'admin',       'display_name' => 'admin',          'description' => 'System Admin',         'allowed_route' => 'admin']);
        $userRole           = Role::create(['name' => 'user',        'display_name' => 'User',           'description' => 'System User',          'allowed_route' => 'admin']);

        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'System Administrator',
            'email' => 'superAdmin@superAdmin.com',
            'mobile' => '01234567890',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'user_image'=>'avatar.PNG',
            'remember_token' => Str::random(10),
        ]);
        $superAdmin->attachRole($superAdminRole);


        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'username' => 'System Admin',
            'email' => 'admin@admin.com',
            'mobile' => '01234567880',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'user_image'=>'avatar.PNG',
            'remember_token' => Str::random(10),
        ]);
        $admin->attachRole($adminRole);


        $user = User::create([
            'first_name' => 'User',
            'last_name' => 'System',
            'username' => 'System User',
            'email' => 'user@user.com',
            'mobile' => '01234567800',
            'password' => bcrypt('password'),
            'email_verified_at' => Carbon::now(),
            'user_image'=>'avatar.PNG',
            'remember_token' => Str::random(10),
        ]);
        $user->attachRole($userRole);


        // MAIN
        $manageMain = Permission::create([
            'name' => 'main',                           //اسم الصلاحية اللي هعملها
            'display_name' => 'Main Dashboard',                   //الاسم اللي هيظهر عند اختيارها
            'description' => 'Administrator Dashboard', //وصف لهذة الصلاحية
            'route' => 'index',                         //الراوت اللي هيووصلني بيه
            'module' => 'index',                        //كيفية الوصول اليها او الراوت بتاعها
            'as' => 'index',                            //
            'icon' => 'fa fa-home',                     //اللي هتظهر قبلها
            'parent' => '0',                            //
            'parent_original' => '0',                   //
            'sidebar_link' => '1',                      //هيكون موجود في السايدبار
            'appear' => '1',                            //هيكون ظاهر و لا مخفي
            'ordering' => '1',                          //اول لينك هيظهر في السايدبار
        ]);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();


        //Home
        $manageHome = Permission::create([ 'name' => 'manage_home', 'display_name' => 'Home (Front)', 'route' => 'Home', 'module' => 'Home', 'as' => 'Home', 'icon' => 'fas fa-laptop-house', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '40', ]);
        $manageHome->parent_show = $manageHome->id;
        $manageHome->save();
            ##Slider
            $showSlider     = Permission::create([ 'name' => 'home_slider',          'display_name' => 'Home Slider',        'route' => 'sliders.index',          'module' => 'Home', 'as' => 'sliders.index',       'icon' => 'fas fa-images',                  'parent' => $manageHome->id, 'parent_show' => $manageHome->id, 'parent_original' => $manageHome->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Project
            $showProject    = Permission::create([ 'name' => 'home_project',        'display_name' => 'Home Project',       'route' => 'projects.index',         'module' => 'Home', 'as' => 'projects.index',      'icon' => 'fas fa-laptop-house',             'parent' => $manageHome->id, 'parent_show' => $manageHome->id, 'parent_original' => $manageHome->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Services
            $showServices   = Permission::create([ 'name' => 'home_services',        'display_name' => 'Home Services',       'route' => 'services.index',         'module' => 'Home', 'as' => 'services.index',      'icon' => 'fas fa-hands-helping',             'parent' => $manageHome->id, 'parent_show' => $manageHome->id, 'parent_original' => $manageHome->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Messages
            $showMessages    = Permission::create([ 'name' => 'home_messages',        'display_name' => 'Home Messages',       'route' => 'messages.index',         'module' => 'Home', 'as' => 'messages.index',            'icon' => 'fas fa-envelope-open-text',      'parent' => $manageHome->id, 'parent_show' => $manageHome->id, 'parent_original' => $manageHome->id,'sidebar_link' => '1', 'appear' => '1', ]);


        //Kayan
        $manageKayan = Permission::create([ 'name' => 'manage_kayan', 'display_name' => 'Kayan', 'route' => 'kayan', 'module' => 'kayan', 'as' => 'kayan', 'icon' => 'fas fa-user-md', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '45', ]);
        $manageKayan->parent_show = $manageKayan->id;
        $manageKayan->save();
            ##Slider
            $showSlider    = Permission::create([ 'name' => 'kayan_slider',          'display_name' => 'Kayan Slider',        'route' => 'kayan.sliders.index',          'module' => 'kayan', 'as' => 'kayan.sliders.index',       'icon' => 'fas fa-images',                  'parent' => $manageKayan->id, 'parent_show' => $manageKayan->id, 'parent_original' => $manageKayan->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Service
            $showProject    = Permission::create([ 'name' => 'kayan_project',        'display_name' => 'Kayan Project',       'route' => 'kayan.projects.index',         'module' => 'kayan', 'as' => 'kayan.projects.index',      'icon' => 'fas fa-user-md',                 'parent' => $manageKayan->id, 'parent_show' => $manageKayan->id, 'parent_original' => $manageKayan->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Messages
            $showMessages    = Permission::create([ 'name' => 'kayan_messages',        'display_name' => 'Kayan Messages',       'route' => 'kayan.messages.index',            'module' => 'kayan', 'as' => 'kayan.messages.index',            'icon' => 'fas fa-envelope-open-text',      'parent' => $manageKayan->id, 'parent_show' => $manageKayan->id, 'parent_original' => $manageKayan->id,'sidebar_link' => '1', 'appear' => '1', ]);


        //Infinity
        $manageInfinity = Permission::create([ 'name' => 'manage_infinity', 'display_name' => 'Infinity', 'route' => 'Infinity', 'module' => 'Infinity', 'as' => 'Infinity', 'icon' => 'fas fa-utensils', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '50', ]);
        $manageInfinity->parent_show = $manageInfinity->id;
        $manageInfinity->save();
            ##Slider
            $showSlider     = Permission::create([ 'name' => 'infinity_slider',          'display_name' => 'Infinity Slider',        'route' => 'infinity.sliders.index',          'module' => 'Infinity', 'as' => 'infinity.sliders.index',       'icon' => 'fas fa-images',                  'parent' => $manageInfinity->id, 'parent_show' => $manageInfinity->id, 'parent_original' => $manageInfinity->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Project
            $showProject    = Permission::create([ 'name' => 'infinity_project',        'display_name' => 'Infinity Project',       'route' => 'infinity.projects.index',         'module' => 'Infinity', 'as' => 'infinity.projects.index',      'icon' => 'fas fa-utensils',                 'parent' => $manageInfinity->id, 'parent_show' => $manageInfinity->id, 'parent_original' => $manageInfinity->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Messages
            $showMessages    = Permission::create([ 'name' => 'infinity_messages',        'display_name' => 'Infinity Messages',       'route' => 'infinity.messages.index',            'module' => 'Infinity', 'as' => 'infinity.messages.index',            'icon' => 'fas fa-envelope-open-text',                 'parent' => $manageInfinity->id, 'parent_show' => $manageInfinity->id, 'parent_original' => $manageInfinity->id,'sidebar_link' => '1', 'appear' => '1', ]);


        //Our Work
        $manageOurWork = Permission::create([ 'name' => 'manage_our_work', 'display_name' => 'Our-Work', 'route' => 'OurWork', 'module' => 'OurWork', 'as' => 'OurWork', 'icon' => 'fas fa-people-carry', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '55', ]);
        $manageOurWork->parent_show = $manageOurWork->id;
        $manageOurWork->save();
            ##Slider
            $showSlider     = Permission::create([ 'name' => 'our_work_slider',          'display_name' => 'Our-Work Slider',         'route' => 'our-work.sliders.index',      'module' => 'OurWork',      'as' => 'our-work.sliders.index',       'icon' => 'fas fa-images',                  'parent' => $manageOurWork->id, 'parent_show' => $manageOurWork->id, 'parent_original' => $manageOurWork->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Project
            $showProject    = Permission::create([ 'name' => 'our_work_project',         'display_name' => 'Our-Work Project',        'route' => 'our-work.projects.index',     'module' => 'OurWork',      'as' => 'our-work.projects.index',      'icon' => 'fas fa-chalkboard-teacher',      'parent' => $manageOurWork->id, 'parent_show' => $manageOurWork->id, 'parent_original' => $manageOurWork->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Services
            $showServices   = Permission::create([ 'name' => 'our_work_services',        'display_name' => 'Our-Work Services',       'route' => 'our-work.services.index',     'module' => 'OurWork',      'as' => 'our-work.services.index',      'icon' => 'fas fa-hands-helping',           'parent' => $manageOurWork->id, 'parent_show' => $manageOurWork->id, 'parent_original' => $manageOurWork->id,'sidebar_link' => '1', 'appear' => '1', ]);
            // ##Messages
            $showMessages   = Permission::create([ 'name' => 'our_work_messages',        'display_name' => 'Our-Work Messages',       'route' => 'our-work.messages.index',              'module' => 'OurWork',      'as' => 'our-work.messages.index',               'icon' => 'fas fa-envelope-open-text',      'parent' => $manageOurWork->id, 'parent_show' => $manageOurWork->id, 'parent_original' => $manageOurWork->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Project Details
            $showProjectDetails   = Permission::create([ 'name' => 'project_details',        'display_name' => 'Project Details',       'route' => 'our-work.projectDetails.index',              'module' => 'OurWork',      'as' => 'our-work.projectDetails.index',               'icon' => 'fas fa-laptop-code',      'parent' => $manageOurWork->id, 'parent_show' => $manageOurWork->id, 'parent_original' => $manageOurWork->id,'sidebar_link' => '1', 'appear' => '1', ]);


        //Careers
        $manageCareers = Permission::create([ 'name' => 'manage_careers', 'display_name' => 'Careers', 'route' => 'careers', 'module' => 'careers', 'as' => 'careers.index', 'icon' => 'fas fa-briefcase', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '90', ]);
        $manageCareers->parent_show = $manageCareers->id;
        $manageCareers->save();
            #Careers
            $showCareers    = Permission::create([ 'name' => 'show_careers',          'display_name' => 'Show Careers',         'route' => 'careers.index',          'module' => 'careers', 'as' => 'careers.index',       'icon' => 'fas fa-briefcase',    'parent' => $manageCareers->id, 'parent_show' => $manageCareers->id, 'parent_original' => $manageCareers->id,'sidebar_link' => '1', 'appear' => '1', ]);
            #Applies
            $showApplies   = Permission::create([ 'name' => 'show_applies',           'display_name' => 'Jobs Applies',         'route' => 'applies.index',          'module' => 'careers', 'as' => 'applies.index',       'icon' => 'fas fa-file-alt',    'parent' => $manageCareers->id, 'parent_show' => $manageCareers->id, 'parent_original' => $manageCareers->id,'sidebar_link' => '1', 'appear' => '1', ]);


        //Contact
        $manageContacts = Permission::create([ 'name' => 'manage_contacts', 'display_name' => 'Contacts', 'route' => 'Contacts', 'module' => 'Contacts', 'as' => 'Contacts', 'icon' => 'fas fa-mobile-alt', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '95', ]);
        $manageContacts->parent_show = $manageContacts->id;
        $manageContacts->save();
            ##Social Media
            $showSocials    = Permission::create([ 'name' => 'show_social',          'display_name' => 'Social Media',        'route' => 'socials.index',          'module' => 'Contacts', 'as' => 'socials.index',       'icon' => 'fas fa-thumbs-up',                  'parent' => $manageContacts->id, 'parent_show' => $manageContacts->id, 'parent_original' => $manageContacts->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Phone Number
            $showPhones    = Permission::create([ 'name' => 'show_phone',          'display_name' => 'Phones',             'route' => 'phones.index',          'module' => 'Contacts', 'as' => 'phones.index',       'icon' => 'fas fa-phone-square-alt',                  'parent' => $manageContacts->id, 'parent_show' => $manageContacts->id, 'parent_original' => $manageContacts->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##E_Mail
            $showEmails    = Permission::create([ 'name' => 'show_email',          'display_name' => 'E-Mails',             'route' => 'emails.index',          'module' => 'Contacts', 'as' => 'emails.index',       'icon' => 'fas fa-envelope-open-text',                  'parent' => $manageContacts->id, 'parent_show' => $manageContacts->id, 'parent_original' => $manageContacts->id,'sidebar_link' => '1', 'appear' => '1', ]);
            // ##Messages
            $showMessages    = Permission::create([ 'name' => 'show_contact_messages',        'display_name' => 'Inbox Messages',       'route' => 'contact-messages.index',            'module' => 'Contacts', 'as' => 'contact-messages.index',            'icon' => 'fas fa-sms',                 'parent' => $manageContacts->id, 'parent_show' => $manageContacts->id, 'parent_original' => $manageContacts->id,'sidebar_link' => '1', 'appear' => '1', ]);


        //Settings
        $manageSettings = Permission::create([ 'name' => 'manage_settings', 'display_name' => 'Settings', 'route' => 'Settings', 'module' => 'Settings', 'as' => 'Settings', 'icon' => 'fas fa-cogs', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '105', ]);
        $manageSettings->parent_show = $manageSettings->id;
        $manageSettings->save();
            ##Logos
            $showLogos    = Permission::create([ 'name' => 'show_logo',          'display_name' => 'Website Logo',              'route' => 'logos.index',          'module' => 'Settings', 'as' => 'logos.index',       'icon' => 'fas fa-blog',                  'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Processes
            $showProcesses= Permission::create([ 'name' => 'show_processes',      'display_name' => 'Website Processes',        'route' => 'processes.index',      'module' => 'Settings', 'as' => 'processes.index',       'icon' => 'fas fa-walking',           'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Pages Titles
            $showPages    = Permission::create([ 'name' => 'show_page_title',      'display_name' => 'Page Titles',        'route' => 'page-titles.index',      'module' => 'Settings', 'as' => 'page-titles.index',       'icon' => 'fas fa-heading',           'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##Locations
            $showLocations= Permission::create([ 'name' => 'show_locations',      'display_name' => 'Company Location',        'route' => 'locations.index',      'module' => 'Settings', 'as' => 'locations.index',       'icon' => 'fas fa-map-marker-alt',           'parent' => $manageSettings->id, 'parent_show' => $manageSettings->id, 'parent_original' => $manageSettings->id,'sidebar_link' => '1', 'appear' => '1', ]);

        //About Us
        $manageAbouts = Permission::create([ 'name' => 'manage_about', 'display_name' => 'About Us', 'route' => 'AboutUs', 'module' => 'AboutUs', 'as' => 'About Us', 'icon' => 'fas fa-id-card-alt', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '1', 'appear' => '1', 'ordering' => '100', ]);
        $manageAbouts->parent_show = $manageAbouts->id;
        $manageAbouts->save();
            ##Social Media
            $showTechnologies    = Permission::create([ 'name' => 'show_technology',          'display_name' => 'Technologies',            'route' => 'technologies.index',          'module' => 'AboutUs', 'as' => 'technologies.index',       'icon' => 'fas fa-laptop-code',                  'parent' => $manageAbouts->id, 'parent_show' => $manageAbouts->id, 'parent_original' => $manageAbouts->id,'sidebar_link' => '1', 'appear' => '1', ]);
            ##About Us
            $showAbouts    = Permission::create([ 'name' => 'show_about',                      'display_name' => 'About Us',              'route' => 'abouts.index',          'module' => 'AboutUs', 'as' => 'abouts.index',       'icon' => 'fas fa-address-card',                  'parent' => $manageAbouts->id, 'parent_show' => $manageAbouts->id, 'parent_original' => $manageAbouts->id,'sidebar_link' => '1', 'appear' => '1', ]);





        //Admins
        $manageAdmins = Permission::create([ 'name' => 'manage_admins', 'display_name' => 'Admins', 'route' => 'admins', 'module' => 'admins', 'as' => 'admins.index', 'icon' => 'fas fa-user-shield', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '0', 'appear' => '1', 'ordering' => '200', ]);
        $manageAdmins->parent_show = $manageAdmins->id;
        $manageAdmins->save();
        $showAdmins    = Permission::create([ 'name' => 'show_admins',          'display_name' => 'Show All Admins',     'route' => 'admins.index',          'module' => 'admins', 'as' => 'admins.index',       'icon' => 'fas fa-user-shield',  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createAdmins  = Permission::create([ 'name' => 'create_admins',        'display_name' => 'Create Admins',       'route' => 'admins.create',         'module' => 'admins', 'as' => 'admins.create',      'icon' => null,                  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $displayAdmins = Permission::create([ 'name' => 'display_admins',       'display_name' => 'Display Admins',      'route' => 'admins.show',           'module' => 'admins', 'as' => 'admins.show',        'icon' => null,                  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateAdmins  = Permission::create([ 'name' => 'update_admins',        'display_name' => 'Update Admins',       'route' => 'admins.edit',           'module' => 'admins', 'as' => 'admins.edit',        'icon' => null,                  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyAdmins = Permission::create([ 'name' => 'delete_admins',        'display_name' => 'Delete Admins',       'route' => 'admins.destroy',        'module' => 'admins', 'as' => 'admins.destroy',     'icon' => null,                  'parent' => $manageAdmins->id, 'parent_show' => $manageAdmins->id, 'parent_original' => $manageAdmins->id,'sidebar_link' => '1', 'appear' => '0', ]);

        //Users
        $manageUsers = Permission::create([ 'name' => 'manage_users', 'display_name' => 'Users', 'route' => 'admins', 'module' => 'users', 'as' => 'users.index', 'icon' => 'fas fa-users', 'parent' => '0', 'parent_original' => '0','sidebar_link' => '0', 'appear' => '1', 'ordering' => '210', ]);
        $manageUsers->parent_show = $manageUsers->id;
        $manageUsers->save();
        $showUsers    = Permission::create([ 'name' => 'show_users',          'display_name' => 'Show All Users',     'route' => 'users.index',          'module' => 'users', 'as' => 'users.index',       'icon' => 'fas fa-users',        'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '1', 'appear' => '1', ]);
        $createUsers  = Permission::create([ 'name' => 'create_users',        'display_name' => 'Create Users',       'route' => 'users.create',         'module' => 'users', 'as' => 'users.create',      'icon' => null,                  'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $displayUsers = Permission::create([ 'name' => 'display_users',       'display_name' => 'Display Users',      'route' => 'users.show',           'module' => 'users', 'as' => 'users.show',        'icon' => null,                  'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $updateUsers  = Permission::create([ 'name' => 'update_users',        'display_name' => 'Update Users',       'route' => 'users.edit',           'module' => 'users', 'as' => 'users.edit',        'icon' => null,                  'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '1', 'appear' => '0', ]);
        $destroyUsers = Permission::create([ 'name' => 'delete_users',        'display_name' => 'Delete Users',       'route' => 'users.destroy',        'module' => 'users', 'as' => 'users.destroy',     'icon' => null,                  'parent' => $manageUsers->id, 'parent_show' => $manageUsers->id, 'parent_original' => $manageUsers->id,'sidebar_link' => '1', 'appear' => '0', ]);



















    }
}
