-- convert Laravel migrations to raw SQL scripts --

-- migration:2014_10_12_200000_add_two_factor_columns_to_users_table --
alter table 
  `users` 
add 
  `two_factor_secret` text null 
after 
  `password`, 
add 
  `two_factor_recovery_codes` text null 
after 
  `two_factor_secret`, 
add 
  `current_team_id` bigint unsigned null, 
add 
  `profile_photo_path` varchar(2048) null;

-- migration:2019_12_14_000001_create_personal_access_tokens_table --
create table `personal_access_tokens` (
  `id` bigint unsigned not null auto_increment primary key, 
  `tokenable_type` varchar(255) not null, 
  `tokenable_id` bigint unsigned not null, 
  `name` varchar(255) not null, 
  `token` varchar(64) not null, 
  `abilities` text null, 
  `last_used_at` timestamp null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `personal_access_tokens` 
add 
  index `personal_access_tokens_tokenable_type_tokenable_id_index`(
    `tokenable_type`, `tokenable_id`
  );
alter table 
  `personal_access_tokens` 
add 
  unique `personal_access_tokens_token_unique`(`token`);

-- migration:2021_06_19_055618_create_sessions_table --
create table `sessions` (
  `id` varchar(255) not null, 
  `user_id` bigint unsigned null, 
  `ip_address` varchar(45) null, 
  `user_agent` text null, 
  `payload` text not null, 
  `last_activity` int not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `sessions` 
add 
  primary key `sessions_id_primary`(`id`);
alter table 
  `sessions` 
add 
  index `sessions_user_id_index`(`user_id`);
alter table 
  `sessions` 
add 
  index `sessions_last_activity_index`(`last_activity`);

-- migration:2021_06_19_143442_add_nig_to_users_table --
alter table 
  `users` 
add 
  `nig` varchar(255) null 
after 
  `level`;

-- migration:2021_06_19_152007_create_teacher_nigs_table --
create table `teacher_nigs` (
  `id` bigint unsigned not null auto_increment primary key, 
  `number` varchar(255) not null, 
  `account` tinyint(1) not null default '0', 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `teacher_nigs` 
add 
  unique `teacher_nigs_number_unique`(`number`);

-- migration:2021_06_27_000758_add_columns_to_userprofiles_table --
alter table 
  `userprofiles` 
add 
  `marriage` varchar(255) not null default 'Belum Menikah', 
add 
  `ktp` varchar(255) null, 
add 
  `npwp` varchar(255) null, 
add 
  `blood` varchar(255) null, 
add 
  `childnum` int not null default '1', 
add 
  `siblings` int not null default '0';

-- migration:2021_06_27_182340_create_userpartners_table --
create table `userpartners` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned null, 
  `name` varchar(255) null, 
  `phone` varchar(255) null, 
  `education` varchar(255) null, 
  `work` varchar(255) null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `userpartners` 
add 
  constraint `userpartners_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete 
set 
  null on update cascade;

-- migration:2021_06_27_184349_create_userchildrens_table --
create table `userchildrens` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned null, 
  `name` varchar(255) null, 
  `birthplace` varchar(255) null, 
  `birthdate` date null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `userchildrens` 
add 
  constraint `userchildrens_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete 
set 
  null on update cascade;

-- migration:2021_06_27_192402_add_columns_to_userchildrens_table --
alter table 
  `userchildrens` 
add 
  `gender` tinyint(1) not null default '1';

-- migration:2021_06_27_193535_create_usereducations_table --
create table `usereducations` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned null, 
  `level` int null, 
  `name` varchar(255) null, 
  `faculty` varchar(255) null, 
  `focus` varchar(255) null, 
  `semester` int null, 
  `address` text null, 
  `in` year null, 
  `out` year null, 
  `certificate` varchar(255) null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `usereducations` 
add 
  constraint `usereducations_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete 
set 
  null on update cascade;

-- migration:2021_06_27_204742_create_userworks_table --
create table `userworks` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned null, 
  `name` varchar(255) null, 
  `address` text null, 
  `in` year null, 
  `out` year null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `userworks` 
add 
  constraint `userworks_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete 
set 
  null on update cascade;

-- migration:2021_06_28_001958_add_more_columns_to_userprofiles_table --
alter table 
  `userprofiles` 
add 
  `fname` varchar(255) null, 
add 
  `fphone` varchar(255) null, 
add 
  `fstatus` tinyint(1) not null default '1', 
add 
  `mname` varchar(255) null, 
add 
  `mphone` varchar(255) null, 
add 
  `mstatus` tinyint(1) not null default '1', 
add 
  `paddress` longtext null, 
add 
  `arts` text null, 
add 
  `sports` text null, 
add 
  `organizations` text null, 
add 
  `others` text null;

-- migration:2021_06_29_122818_add_columns_to_teacher_nigs_table --
alter table 
  `teacher_nigs` 
add 
  `user_id` bigint unsigned null;
alter table 
  `teacher_nigs` 
add 
  constraint `teacher_nigs_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete 
set 
  null on update cascade;
alter table 
  `teacher_nigs` 
drop 
  `account`;

-- migration:2021_07_03_215629_create_gatherings_table --
create table `gatherings` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) not null, 
  `description` text null, 
  `held_at` timestamp not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

-- migration:2021_07_03_220531_create_gathering_user_table --
create table `gathering_user` (
  `gathering_id` bigint unsigned not null, 
  `user_id` bigint unsigned not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `gathering_user` 
add 
  constraint `gathering_user_gathering_id_foreign` foreign key (`gathering_id`) references `gatherings` (`id`) on delete cascade on update cascade;
alter table 
  `gathering_user` 
add 
  constraint `gathering_user_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

-- migration:2021_07_04_211908_create_userpermits_table --
create table `userpermits` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned not null, 
  `category` int not null, `description` text null, 
  `signed_at` timestamp not null, `started_at` timestamp not null, 
  `ended_at` timestamp not null, `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `userpermits` 
add 
  constraint `userpermits_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

-- migration:2021_07_05_163354_create_userassignments_table --
create table `userassignments` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned not null, 
  `category` int not null, 
  `decree` varchar(255) not null, 
  `description` text null, 
  `signed_at` timestamp not null, 
  `started_at` timestamp not null, 
  `ended_at` timestamp null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `userassignments` 
add 
  constraint `userassignments_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

-- migration:2021_07_07_131838_create_userteachings_table --
create table `userteachings` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned not null, 
  `classroom_id` bigint unsigned null, 
  `signed_at` timestamp not null, `category` int not null, 
  `description` text null, `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `userteachings` 
add 
  constraint `userteachings_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;
alter table 
  `userteachings` 
add 
  constraint `userteachings_classroom_id_foreign` foreign key (`classroom_id`) references `classrooms` (`id`) on delete 
set 
  null on update cascade;

-- migration:2021_07_07_194141_create_userevaluations_table --
create table `userevaluations` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned not null, 
  `signed_at` timestamp not null, 
  `decree` varchar(255) null, 
  `category` int not null, 
  `description` text null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `userevaluations` 
add 
  constraint `userevaluations_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

-- migration:2021_07_07_222413_create_teachingscores_table --
create table `teachingscores` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned not null, 
  `scored_at` timestamp not null, `c1` bigint not null default '0', 
  `c2` bigint not null default '0', `c3` bigint not null default '0', 
  `c4` bigint not null default '0', `c5` bigint not null default '0', 
  `c6` bigint not null default '0', `description` text null, 
  `created_at` timestamp null, `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `teachingscores` 
add 
  constraint `teachingscores_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;

-- migration:2021_07_08_125819_create_managementscores_table --
create table `managementscores` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned not null, 
  `scored_at` timestamp not null, `c1` bigint not null default '0', 
  `c2` bigint not null default '0', `c3` bigint not null default '0', 
  `c4` bigint not null default '0', `c5` bigint not null default '0', 
  `c6` bigint not null default '0', `description` text null, 
  `created_at` timestamp null, `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `managementscores` 
add 
  constraint `managementscores_user_id_foreign` foreign key (`user_id`) references `users` (`id`) on delete cascade on update cascade;
