<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();

        \DB::table('properties')->truncate();

        // factory(Property::class, 10)->create();
        // \App\Models\Property::factory(10)->create();

        \DB::statement("INSERT INTO `properties` (`id`, `estate_property_type_id`, `client_id`, `unique_number`, `payment_plan_id`, `date_of_first_payment`, `created_at`, `updated_at`) VALUES
        (1, 1, 1, 'RRSH01', 1, NULL, '2021-12-23 23:22:08', '2021-12-24 07:51:05'),
        (2, 1, 2, 'RRSH02', 1, NULL, '2021-12-23 23:26:38', '2021-12-24 07:54:27'),
        (3, 1, 3, 'RRSH03', 1, NULL, '2021-12-23 23:27:02', '2021-12-24 07:58:55'),
        (4, 1, 4, 'RRSH04', 3, NULL, '2021-12-23 23:27:23', '2021-12-24 08:02:58'),
        (5, 1, 5, 'RRSH05', 1, NULL, '2021-12-23 23:27:45', '2021-12-24 08:07:49'),
        (6, 1, 6, 'RRSH06', 1, NULL, '2021-12-23 23:28:21', '2021-12-24 08:09:18'),
        (7, 1, 7, 'RRSH07', 2, NULL, '2021-12-23 23:28:34', '2021-12-24 08:11:53'),
        (8, 1, 8, 'RRSH08', 2, NULL, '2021-12-23 23:28:51', '2021-12-24 08:14:51'),
        (9, 1, 9, 'RRSH09', 2, NULL, '2021-12-23 23:29:12', '2021-12-24 08:17:59'),
        (10, 1, 10, 'RRSH10', 2, NULL, '2021-12-23 23:29:27', '2021-12-24 08:19:46'),
        (11, 1, 11, 'RRSH11', 2, NULL, '2021-12-23 23:29:45', '2021-12-24 08:26:00'),
        (12, 1, 12, 'RRSH12', 2, NULL, '2021-12-23 23:30:06', '2021-12-24 08:28:57'),
        (13, 1, 13, 'RRSH13', 3, NULL, '2021-12-23 23:30:42', '2021-12-24 08:50:09'),
        (14, 1, 14, 'RRSH14', 2, NULL, '2021-12-23 23:30:57', '2021-12-24 11:38:49'),
        (15, 1, 15, 'RRSH15', 2, NULL, '2021-12-23 23:31:28', '2021-12-24 11:43:44'),
        (16, 1, 16, 'RRSH16', 2, NULL, '2021-12-23 23:31:45', '2021-12-24 11:45:22'),
        (17, 1, 17, 'RRSH17', 2, NULL, '2021-12-23 23:32:09', '2021-12-24 11:50:33'),
        (18, 1, 22, 'RRSH18', 2, NULL, '2021-12-23 23:32:23', '2021-12-24 11:58:06'),
        (19, 1, 23, 'RRSH19', 2, NULL, '2021-12-23 23:32:51', '2021-12-24 12:12:13'),
        (20, 1, 24, 'RRSH20', 2, NULL, '2021-12-23 23:33:05', '2021-12-24 12:15:53'),
        (21, 1, 25, 'RRSH21', 2, NULL, '2021-12-23 23:33:36', '2021-12-24 12:20:36'),
        (22, 1, 26, 'RRSH22', 2, NULL, '2021-12-23 23:33:49', '2021-12-24 12:24:41'),
        (23, 1, 27, 'RRSH23', 2, NULL, '2021-12-23 23:34:02', '2021-12-24 12:35:11'),
        (24, 1, 28, 'RRSH24', 2, NULL, '2021-12-23 23:34:18', '2021-12-24 12:43:17'),
        (25, 1, 29, 'RRSH25', 2, NULL, '2021-12-23 23:34:34', '2021-12-24 12:44:14'),
        (26, 1, 30, 'RRSH26', 2, NULL, '2021-12-23 23:34:56', '2021-12-24 12:47:23'),
        (27, 1, 31, 'RRSH27', 2, NULL, '2021-12-23 23:35:30', '2021-12-24 12:50:55'),
        (28, 1, 32, 'RRSH28', 2, NULL, '2021-12-23 23:35:51', '2021-12-24 12:52:13'),
        (29, 1, 35, 'RRSH29', 2, NULL, '2021-12-23 23:36:06', '2021-12-24 12:56:06'),
        (30, 1, 36, 'RRSH30', 2, NULL, '2021-12-23 23:36:21', '2021-12-24 13:09:29'),
        (31, 1, 37, 'RRSH31', 2, NULL, '2021-12-23 23:36:36', '2021-12-24 13:13:46'),
        (32, 1, 43, 'RRSH32', 2, NULL, '2021-12-23 23:37:04', '2021-12-24 13:16:14'),
        (33, 1, 44, 'RRSH33', 2, NULL, '2021-12-23 23:37:16', '2021-12-24 13:19:01'),
        (34, 1, 45, 'RRSH34', 2, NULL, '2021-12-23 23:37:38', '2021-12-24 13:32:28'),
        (35, 1, 46, 'RRSH35', 2, NULL, '2021-12-23 23:38:10', '2021-12-24 13:48:43'),
        (36, 1, NULL, 'RRSH36', NULL, NULL, '2021-12-23 23:38:34', '2021-12-23 23:38:34'),
        (37, 1, NULL, 'RRSH37', NULL, NULL, '2021-12-23 23:38:45', '2021-12-23 23:38:45'),
        (38, 1, NULL, 'RRSH38', NULL, NULL, '2021-12-23 23:38:59', '2021-12-23 23:38:59'),
        (39, 1, NULL, 'RRSH39', NULL, NULL, '2021-12-23 23:39:12', '2021-12-23 23:39:12'),
        (40, 1, 49, 'RRSH40', 2, NULL, '2021-12-23 23:39:32', '2021-12-25 14:12:55'),
        (41, 1, 47, 'RRSH41', 2, NULL, '2021-12-23 23:39:47', '2021-12-25 14:09:56'),
        (42, 1, 48, 'RRSH42', 2, NULL, '2021-12-23 23:40:01', '2021-12-25 14:11:29'),
        (43, 1, 50, 'RRSH43', 2, NULL, '2021-12-23 23:40:13', '2021-12-25 14:16:40'),
        (44, 1, 51, 'RRSH44', 2, NULL, '2021-12-23 23:40:34', '2021-12-25 14:23:15'),
        (45, 1, 52, 'RRSH45', 2, NULL, '2021-12-23 23:40:49', '2021-12-25 14:25:27'),
        (46, 1, 53, 'RRSH46', 2, NULL, '2021-12-23 23:41:01', '2021-12-25 14:27:40'),
        (47, 1, 54, 'RRSH47', 2, NULL, '2021-12-23 23:41:13', '2021-12-25 14:35:05'),
        (48, 1, 55, 'RRSH48', 2, NULL, '2021-12-23 23:41:29', '2021-12-25 14:37:24'),
        (49, 1, NULL, 'RRSH49', NULL, NULL, '2021-12-23 23:42:35', '2021-12-23 23:42:35'),
        (50, 1, 57, 'RRSH50', 2, NULL, '2021-12-23 23:49:23', '2021-12-25 22:27:46'),
        (51, 1, 56, 'RRSH51', 2, NULL, '2021-12-23 23:49:42', '2021-12-25 22:24:53'),
        (52, 1, 58, 'RRSH52', 2, NULL, '2021-12-23 23:49:59', '2021-12-25 22:30:11'),
        (53, 1, 59, 'RRSH53', 2, NULL, '2021-12-23 23:50:16', '2021-12-25 22:31:22'),
        (54, 1, NULL, 'RRSH54', NULL, NULL, '2021-12-23 23:51:04', '2021-12-23 23:51:04'),
        (55, 1, NULL, 'RRSH55', NULL, NULL, '2021-12-23 23:52:14', '2021-12-23 23:52:14'),
        (56, 2, 60, 'RRSHPP01', 2, NULL, '2021-12-24 00:07:05', '2021-12-26 14:31:48'),
        (57, 2, NULL, 'RRSHPP02', NULL, NULL, '2021-12-24 00:09:57', '2021-12-24 00:09:57'),
        (58, 2, NULL, 'RRSHPP03', NULL, NULL, '2021-12-24 00:10:34', '2021-12-24 00:10:34'),
        (59, 2, NULL, 'RRSHPP04', NULL, NULL, '2021-12-24 00:10:47', '2021-12-24 00:10:47'),
        (60, 2, NULL, 'RRSHPP05', NULL, NULL, '2021-12-24 00:11:00', '2021-12-24 00:11:00'),
        (61, 2, NULL, 'RRSHPP06', NULL, NULL, '2021-12-24 00:11:14', '2021-12-24 00:11:14'),
        (62, 2, NULL, 'RRSHPP07', NULL, NULL, '2021-12-24 00:11:28', '2021-12-24 00:11:28'),
        (63, 2, NULL, 'RRSHPP08', NULL, NULL, '2021-12-24 00:11:43', '2021-12-24 00:11:43'),
        (64, 2, NULL, 'RRSHPP09', NULL, NULL, '2021-12-24 00:13:47', '2021-12-24 00:13:47'),
        (65, 2, NULL, 'RRSHPP10', NULL, NULL, '2021-12-24 00:14:48', '2021-12-24 00:14:48'),
        (66, 2, NULL, 'RRSHPP11', NULL, NULL, '2021-12-24 00:15:03', '2021-12-24 00:15:03'),
        (67, 2, NULL, 'RRSHPP12', NULL, NULL, '2021-12-24 00:15:18', '2021-12-24 00:15:18'),
        (68, 2, NULL, 'RRSHPP14', NULL, NULL, '2021-12-24 00:15:58', '2021-12-24 00:15:58'),
        (69, 2, NULL, 'RRSHPP15', NULL, NULL, '2021-12-24 00:17:04', '2021-12-24 00:17:04'),
        (70, 2, NULL, 'RRSHPP16', NULL, NULL, '2021-12-24 00:17:18', '2021-12-24 00:17:18'),
        (71, 2, NULL, 'RRSHPP17', NULL, NULL, '2021-12-24 00:17:40', '2021-12-24 00:17:40'),
        (72, 2, NULL, 'RRSHPP18', NULL, NULL, '2021-12-24 00:19:19', '2021-12-24 00:19:19'),
        (73, 2, NULL, 'RRSHPP19', NULL, NULL, '2021-12-24 00:19:33', '2021-12-24 00:19:33'),
        (74, 2, NULL, 'RRSHPP20', NULL, NULL, '2021-12-24 00:20:03', '2021-12-24 00:20:03'),
        (75, 2, NULL, 'RRSHPP21', NULL, NULL, '2021-12-24 00:20:29', '2021-12-24 00:20:29'),
        (76, 2, NULL, 'RRSHPP22', NULL, NULL, '2021-12-24 00:20:43', '2021-12-24 00:20:43'),
        (77, 2, NULL, 'RRSHPP23', NULL, NULL, '2021-12-24 00:20:56', '2021-12-24 00:20:56'),
        (78, 2, NULL, 'RRSHPP24', NULL, NULL, '2021-12-24 00:21:12', '2021-12-24 00:21:12'),
        (79, 2, NULL, 'RRSHPP25', NULL, NULL, '2021-12-24 00:21:28', '2021-12-24 00:21:28'),
        (80, 2, NULL, 'RRSHPP26', NULL, NULL, '2021-12-24 00:21:41', '2021-12-24 00:21:41'),
        (81, 2, NULL, 'RRSHPP27', NULL, NULL, '2021-12-24 00:21:54', '2021-12-24 00:21:54'),
        (82, 2, NULL, 'RRSHPP28', NULL, NULL, '2021-12-24 00:22:08', '2021-12-24 00:22:08'),
        (83, 2, NULL, 'RRSHPP29', NULL, NULL, '2021-12-24 00:22:43', '2021-12-24 00:22:43'),
        (84, 2, NULL, 'RRSHPP30', NULL, NULL, '2021-12-24 00:22:58', '2021-12-24 00:22:58'),
        (85, 2, NULL, 'RRSHPP31', NULL, NULL, '2021-12-24 00:23:51', '2021-12-24 00:23:51'),
        (86, 2, NULL, 'RRSHPP32', NULL, NULL, '2021-12-24 00:24:06', '2021-12-24 00:24:06'),
        (87, 2, NULL, 'RRSHPP33', NULL, NULL, '2021-12-24 00:24:29', '2021-12-24 00:24:29'),
        (88, 2, NULL, 'RRSHPP34', NULL, NULL, '2021-12-24 00:24:43', '2021-12-24 00:24:43'),
        (89, 2, NULL, 'RRSHPP35', NULL, NULL, '2021-12-24 00:24:57', '2021-12-24 00:24:57'),
        (90, 2, NULL, 'RRSHPP36', NULL, NULL, '2021-12-24 00:25:09', '2021-12-24 00:25:09'),
        (91, 2, NULL, 'RRSHPP37', NULL, NULL, '2021-12-24 00:25:23', '2021-12-24 00:25:23'),
        (92, 2, NULL, 'RRSHPP38', NULL, NULL, '2021-12-24 00:25:34', '2021-12-24 00:25:34'),
        (93, 2, NULL, 'RRSHPP39', NULL, NULL, '2021-12-24 00:25:48', '2021-12-24 00:25:48'),
        (94, 2, NULL, 'RRSHPP40', NULL, NULL, '2021-12-24 00:26:15', '2021-12-24 00:26:15'),
        (95, 2, NULL, 'RRSHPP41', NULL, NULL, '2021-12-24 00:26:30', '2021-12-24 00:26:30'),
        (96, 2, NULL, 'RRSHPP42', NULL, NULL, '2021-12-24 00:26:45', '2021-12-24 00:26:45')");


        \Schema::enableForeignKeyConstraints();
    }
}
