<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-24 08:19:06 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_log&quot; of relation &quot;xi_sa_log_login&quot; violates not-null constraint
DETAIL:  Failing row contains (null, primaaulia, 1645665546, ::1, Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KH...). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 08:19:06 --> Query error: ERROR:  null value in column "id_log" of relation "xi_sa_log_login" violates not-null constraint
DETAIL:  Failing row contains (null, primaaulia, 1645665546, ::1, Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KH...). - Invalid query: INSERT INTO "xi_sa_log_login" ("username", "login_time", "ip_address", "user_agent") VALUES ('primaaulia', 1645665546, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36')
ERROR - 2022-02-24 08:19:11 --> 404 Page Not Found: /index
ERROR - 2022-02-24 08:19:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 08:19:29 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;Y&quot; does not exist
LINE 2:                                 WHEN &quot;Y&quot; THEN a.url_menu
                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 08:19:29 --> Query error: ERROR:  column "Y" does not exist
LINE 2:                                 WHEN "Y" THEN a.url_menu
                                             ^ - Invalid query: SELECT "a"."id_menu", "a"."title_menu", (CASE a.is_parent
                                WHEN "Y" THEN a.url_menu
                                ELSE IF(LCASE(c.url_module) = LCASE(d.url_kontrol), IF(LCASE(e.url_fungsi) = "index", LCASE(c.url_module), CONCAT(LCASE(c.url_module), "/", LCASE(e.url_fungsi))), IF(LCASE(e.url_fungsi) = "index", CONCAT(LCASE(c.url_module), "/", LCASE(d.url_kontrol)), CONCAT(LCASE(c.url_module), "/", LCASE(d.url_kontrol), "/", LCASE(e.url_fungsi))))
                           END) AS url_menu, "a"."icon_menu", "a"."order_menu", "a"."id_rules", "a"."parent_id", "a"."is_parent"
FROM "xi_sa_menu" "a"
LEFT JOIN "xi_sa_rules" "b" ON "b"."id_rules" = "a"."id_rules"
LEFT JOIN "xi_sa_module" "c" ON "c"."id_module" = "b"."id_module"
LEFT JOIN "xi_sa_kontrol" "d" ON "d"."id_kontrol" = "b"."id_kontrol"
LEFT JOIN "xi_sa_fungsi" "e" ON "e"."id_fungsi" = "b"."id_fungsi"
LEFT JOIN "xi_sa_group_privileges" "f" ON "f"."id_rules" = "b"."id_rules"
LEFT JOIN "xi_sa_group" "g" ON "g"."id_group" = "f"."id_group"
WHERE "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
AND "f"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = '1'
ORDER BY "a"."id_menu" ASC, "a"."order_menu" ASC
ERROR - 2022-02-24 09:41:14 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;Y&quot; does not exist
LINE 2:                                 WHEN &quot;Y&quot; THEN a.url_menu
                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 09:41:14 --> Query error: ERROR:  column "Y" does not exist
LINE 2:                                 WHEN "Y" THEN a.url_menu
                                             ^ - Invalid query: SELECT "a"."id_menu", "a"."title_menu", (CASE a.is_parent
                                WHEN "Y" THEN a.url_menu
                                ELSE IF(LCASE(c.url_module) = LCASE(d.url_kontrol), IF(LCASE(e.url_fungsi) = "index", LCASE(c.url_module), CONCAT(LCASE(c.url_module), "/", LCASE(e.url_fungsi))), IF(LCASE(e.url_fungsi) = "index", CONCAT(LCASE(c.url_module), "/", LCASE(d.url_kontrol)), CONCAT(LCASE(c.url_module), "/", LCASE(d.url_kontrol), "/", LCASE(e.url_fungsi))))
                           END) AS url_menu, "a"."icon_menu", "a"."order_menu", "a"."id_rules", "a"."parent_id", "a"."is_parent"
FROM "xi_sa_menu" "a"
LEFT JOIN "xi_sa_rules" "b" ON "b"."id_rules" = "a"."id_rules"
LEFT JOIN "xi_sa_module" "c" ON "c"."id_module" = "b"."id_module"
LEFT JOIN "xi_sa_kontrol" "d" ON "d"."id_kontrol" = "b"."id_kontrol"
LEFT JOIN "xi_sa_fungsi" "e" ON "e"."id_fungsi" = "b"."id_fungsi"
LEFT JOIN "xi_sa_group_privileges" "f" ON "f"."id_rules" = "b"."id_rules"
LEFT JOIN "xi_sa_group" "g" ON "g"."id_group" = "f"."id_group"
WHERE "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
AND "f"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = '1'
ORDER BY "a"."id_menu" ASC, "a"."order_menu" ASC
ERROR - 2022-02-24 09:42:44 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;Y&quot; does not exist
LINE 2:                                 WHEN &quot;Y&quot; THEN a.url_menu
                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 09:42:44 --> Query error: ERROR:  column "Y" does not exist
LINE 2:                                 WHEN "Y" THEN a.url_menu
                                             ^ - Invalid query: SELECT "a"."id_menu", "a"."title_menu", (CASE a.is_parent
                                WHEN "Y" THEN a.url_menu
                                ELSE IF(LCASE(c.url_module) = LCASE(d.url_kontrol), IF(LCASE(e.url_fungsi) = "index", LCASE(c.url_module), CONCAT(LCASE(c.url_module), "/", LCASE(e.url_fungsi))), IF(LCASE(e.url_fungsi) = "index", CONCAT(LCASE(c.url_module), "/", LCASE(d.url_kontrol)), CONCAT(LCASE(c.url_module), "/", LCASE(d.url_kontrol), "/", LCASE(e.url_fungsi))))
                           END) AS url_menu, "a"."icon_menu", "a"."order_menu", "a"."id_rules", "a"."parent_id", "a"."is_parent"
FROM "xi_sa_menu" "a"
LEFT JOIN "xi_sa_rules" "b" ON "b"."id_rules" = "a"."id_rules"
LEFT JOIN "xi_sa_module" "c" ON "c"."id_module" = "b"."id_module"
LEFT JOIN "xi_sa_kontrol" "d" ON "d"."id_kontrol" = "b"."id_kontrol"
LEFT JOIN "xi_sa_fungsi" "e" ON "e"."id_fungsi" = "b"."id_fungsi"
LEFT JOIN "xi_sa_group_privileges" "f" ON "f"."id_rules" = "b"."id_rules"
LEFT JOIN "xi_sa_group" "g" ON "g"."id_group" = "f"."id_group"
WHERE "a"."id_status" = 1
AND "b"."id_status" = 1
AND "c"."id_status" = 1
AND "d"."id_status" = 1
AND "e"."id_status" = 1
AND "f"."id_status" = 1
AND "g"."id_status" = 1
AND "g"."id_group" = '1'
ORDER BY "a"."id_menu" ASC, "a"."order_menu" ASC
ERROR - 2022-02-24 09:53:52 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:53:52 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:53:56 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:53:56 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:54:08 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 09:54:08 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 09:54:36 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:54:36 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:54:58 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:54:58 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:54:58 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 09:54:58 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 09:55:14 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:55:14 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:55:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:55:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 09:55:20 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 09:55:20 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 10:06:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:06:05 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:06:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:06:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:06:25 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:06:25 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:27:13 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:27:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:27:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:27:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:27:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:27:24 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:27:24 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 10:30:26 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:30:36 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type integer: &quot;&quot;
LINE 5: AND &quot;id_menu&quot; IN('')
                         ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:30:36 --> Query error: ERROR:  invalid input syntax for type integer: ""
LINE 5: AND "id_menu" IN('')
                         ^ - Invalid query: SELECT "id_menu", "title_menu", "url_menu", "icon_menu", "order_menu", "id_rules", "parent_id", "is_parent"
FROM "xi_sa_menu"
WHERE "is_parent" = 'Y'
AND "id_status" = 1
AND "id_menu" IN('')
ORDER BY "id_menu" ASC
ERROR - 2022-02-24 10:35:00 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:35:10 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:35:10 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:35:14 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:35:15 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:35:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:35:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:35:21 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 1: ...DISTINCT(d.label_module) ORDER BY d.id_module ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:35:21 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 1: ...DISTINCT(d.label_module) ORDER BY d.id_module ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_group", "a"."nama_group", "a"."id_level_akses", "a"."id_status", CONCAT("Module: ", GROUP_CONCAT(DISTINCT(d.label_module) ORDER BY d.id_module ASC SEPARATOR ", ")) AS hak_akses, "e"."level_akses"
FROM "xi_sa_group" "a"
LEFT JOIN "xi_sa_group_privileges" "b" ON "a"."id_group" = "b"."id_group" AND "b"."id_status" = 1
LEFT JOIN "xi_sa_rules" "c" ON "b"."id_rules" = "c"."id_rules"
LEFT JOIN "xi_sa_module" "d" ON "c"."id_module" = "d"."id_module"
INNER JOIN "xi_sa_level_akses" "e" ON "a"."id_level_akses" = "e"."id_level_akses"
GROUP BY "a"."id_group"
ORDER BY "a"."id_group" ASC
 LIMIT 10
ERROR - 2022-02-24 10:39:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:39:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:39:27 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:39:27 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:39:27 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:39:27 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 10:39:32 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:39:32 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:39:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 1: ...DISTINCT(d.label_module) ORDER BY d.id_module ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:39:32 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 1: ...DISTINCT(d.label_module) ORDER BY d.id_module ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_group", "a"."nama_group", "a"."id_level_akses", "a"."id_status", CONCAT("Module: ", GROUP_CONCAT(DISTINCT(d.label_module) ORDER BY d.id_module ASC SEPARATOR ", ")) AS hak_akses, "e"."level_akses"
FROM "xi_sa_group" "a"
LEFT JOIN "xi_sa_group_privileges" "b" ON "a"."id_group" = "b"."id_group" AND "b"."id_status" = 1
LEFT JOIN "xi_sa_rules" "c" ON "b"."id_rules" = "c"."id_rules"
LEFT JOIN "xi_sa_module" "d" ON "c"."id_module" = "d"."id_module"
INNER JOIN "xi_sa_level_akses" "e" ON "a"."id_level_akses" = "e"."id_level_akses"
GROUP BY "a"."id_group"
ORDER BY "a"."id_group" ASC
 LIMIT 10
ERROR - 2022-02-24 10:43:13 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:43:13 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:43:13 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;e.level_akses&quot; must appear in the GROUP BY clause or be used in an aggregate function
LINE 1: ...string_agg(d.label_module, ', ' ) ) AS hak_akses, &quot;e&quot;.&quot;level...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:43:13 --> Query error: ERROR:  column "e.level_akses" must appear in the GROUP BY clause or be used in an aggregate function
LINE 1: ...string_agg(d.label_module, ', ' ) ) AS hak_akses, "e"."level...
                                                             ^ - Invalid query: SELECT "a"."id_group", "a"."nama_group", "a"."id_level_akses", "a"."id_status", CONCAT ( 'Module: ', string_agg(d.label_module, ', ' ) ) AS hak_akses, "e"."level_akses"
FROM "xi_sa_group" "a"
LEFT JOIN "xi_sa_group_privileges" "b" ON "a"."id_group" = "b"."id_group" AND "b"."id_status" = 1
LEFT JOIN "xi_sa_rules" "c" ON "b"."id_rules" = "c"."id_rules"
LEFT JOIN "xi_sa_module" "d" ON "c"."id_module" = "d"."id_module"
INNER JOIN "xi_sa_level_akses" "e" ON "a"."id_level_akses" = "e"."id_level_akses"
GROUP BY "a"."id_group"
ORDER BY "a"."id_group" ASC
 LIMIT 10
ERROR - 2022-02-24 10:43:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:43:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:47:17 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_group&quot; of relation &quot;xi_sa_group&quot; violates not-null constraint
DETAIL:  Failing row contains (null, Admin, 2, null, primaaulia, 2022-02-24 10:47:17, ::1, primaaulia, 2022-02-24 10:47:17, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:47:17 --> Query error: ERROR:  null value in column "id_group" of relation "xi_sa_group" violates not-null constraint
DETAIL:  Failing row contains (null, Admin, 2, null, primaaulia, 2022-02-24 10:47:17, ::1, primaaulia, 2022-02-24 10:47:17, ::1, 1). - Invalid query: INSERT INTO "xi_sa_group" ("nama_group", "id_level_akses", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('Admin', '2', 'primaaulia', '2022-02-24 10:47:17', '::1', 'primaaulia', '2022-02-24 10:47:17', '::1', '1')
ERROR - 2022-02-24 10:47:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:47:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:47:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:47:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:47:28 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_group&quot; of relation &quot;xi_sa_group&quot; violates not-null constraint
DETAIL:  Failing row contains (null, Admin, 2, null, primaaulia, 2022-02-24 10:47:28, ::1, primaaulia, 2022-02-24 10:47:28, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:47:28 --> Query error: ERROR:  null value in column "id_group" of relation "xi_sa_group" violates not-null constraint
DETAIL:  Failing row contains (null, Admin, 2, null, primaaulia, 2022-02-24 10:47:28, ::1, primaaulia, 2022-02-24 10:47:28, ::1, 1). - Invalid query: INSERT INTO "xi_sa_group" ("nama_group", "id_level_akses", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('Admin', '2', 'primaaulia', '2022-02-24 10:47:28', '::1', 'primaaulia', '2022-02-24 10:47:28', '::1', '1')
ERROR - 2022-02-24 10:53:20 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable D:\xampp7\htdocs\clear-engine\application\modules\auth\models\Model_auth_signin.php 184
ERROR - 2022-02-24 10:53:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:53:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:53:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:53:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:53:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:54:31 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:54:31 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:54:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_group&quot; of relation &quot;xi_sa_group&quot; violates not-null constraint
DETAIL:  Failing row contains (null, Admin, 2, null, primaaulia, 2022-02-24 10:54:32, ::1, primaaulia, 2022-02-24 10:54:32, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:54:32 --> Query error: ERROR:  null value in column "id_group" of relation "xi_sa_group" violates not-null constraint
DETAIL:  Failing row contains (null, Admin, 2, null, primaaulia, 2022-02-24 10:54:32, ::1, primaaulia, 2022-02-24 10:54:32, ::1, 1). - Invalid query: INSERT INTO "xi_sa_group" ("nama_group", "id_level_akses", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('Admin', '2', 'primaaulia', '2022-02-24 10:54:32', '::1', 'primaaulia', '2022-02-24 10:54:32', '::1', '1')
ERROR - 2022-02-24 10:56:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:56:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:56:45 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_upk&quot; of relation &quot;xi_sa_group&quot; violates not-null constraint
DETAIL:  Failing row contains (3, Admin, 2, null, primaaulia, 2022-02-24 10:56:45, ::1, primaaulia, 2022-02-24 10:56:45, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 10:56:45 --> Query error: ERROR:  null value in column "id_upk" of relation "xi_sa_group" violates not-null constraint
DETAIL:  Failing row contains (3, Admin, 2, null, primaaulia, 2022-02-24 10:56:45, ::1, primaaulia, 2022-02-24 10:56:45, ::1, 1). - Invalid query: INSERT INTO "xi_sa_group" ("nama_group", "id_level_akses", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('Admin', '2', 'primaaulia', '2022-02-24 10:56:45', '::1', 'primaaulia', '2022-02-24 10:56:45', '::1', '1')
ERROR - 2022-02-24 10:57:38 --> 404 Page Not Found: /index
ERROR - 2022-02-24 10:57:38 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:00:13 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_fungsi&quot; of relation &quot;xi_sa_fungsi&quot; violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:00:13, ::1, primaaulia, 2022-02-24 11:00:13, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:00:13 --> Query error: ERROR:  null value in column "id_fungsi" of relation "xi_sa_fungsi" violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:00:13, ::1, primaaulia, 2022-02-24 11:00:13, ::1, 1). - Invalid query: INSERT INTO "xi_sa_fungsi" ("nama_fungsi", "label_fungsi", "url_fungsi", "deskripsi_fungsi", "id_jenis_fungsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('test', 'test', 'test', 'test', '2', 'primaaulia', '2022-02-24 11:00:13', '::1', 'primaaulia', '2022-02-24 11:00:13', '::1', '1')
ERROR - 2022-02-24 11:00:16 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:00:16 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:00:18 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:00:18 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:00:31 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_fungsi&quot; of relation &quot;xi_sa_fungsi&quot; violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:00:31, ::1, primaaulia, 2022-02-24 11:00:31, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:00:31 --> Query error: ERROR:  null value in column "id_fungsi" of relation "xi_sa_fungsi" violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:00:31, ::1, primaaulia, 2022-02-24 11:00:31, ::1, 1). - Invalid query: INSERT INTO "xi_sa_fungsi" ("nama_fungsi", "label_fungsi", "url_fungsi", "deskripsi_fungsi", "id_jenis_fungsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('test', 'test', 'test', 'test', '2', 'primaaulia', '2022-02-24 11:00:31', '::1', 'primaaulia', '2022-02-24 11:00:31', '::1', '1')
ERROR - 2022-02-24 11:01:21 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable D:\xampp7\htdocs\clear-engine\application\modules\auth\models\Model_auth_signin.php 184
ERROR - 2022-02-24 11:01:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:01:31 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:01:31 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:01:37 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:01:37 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:03:37 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:03:38 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:03:48 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_fungsi&quot; of relation &quot;xi_sa_fungsi&quot; violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:03:48, ::1, primaaulia, 2022-02-24 11:03:48, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:03:48 --> Query error: ERROR:  null value in column "id_fungsi" of relation "xi_sa_fungsi" violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:03:48, ::1, primaaulia, 2022-02-24 11:03:48, ::1, 1). - Invalid query: INSERT INTO "xi_sa_fungsi" ("nama_fungsi", "label_fungsi", "url_fungsi", "deskripsi_fungsi", "id_jenis_fungsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('test', 'test', 'test', 'test', '2', 'primaaulia', '2022-02-24 11:03:48', '::1', 'primaaulia', '2022-02-24 11:03:48', '::1', '1')
ERROR - 2022-02-24 11:05:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:05:49 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:05:59 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_level_akses&quot; of relation &quot;xi_sa_fungsi&quot; violates not-null constraint
DETAIL:  Failing row contains (25, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:05:59, ::1, primaaulia, 2022-02-24 11:05:59, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:05:59 --> Query error: ERROR:  null value in column "id_level_akses" of relation "xi_sa_fungsi" violates not-null constraint
DETAIL:  Failing row contains (25, test, test, test, test, 2, null, primaaulia, 2022-02-24 11:05:59, ::1, primaaulia, 2022-02-24 11:05:59, ::1, 1). - Invalid query: INSERT INTO "xi_sa_fungsi" ("nama_fungsi", "label_fungsi", "url_fungsi", "deskripsi_fungsi", "id_jenis_fungsi", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('test', 'test', 'test', 'test', '2', 'primaaulia', '2022-02-24 11:05:59', '::1', 'primaaulia', '2022-02-24 11:05:59', '::1', '1')
ERROR - 2022-02-24 11:06:51 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:06:51 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:07:06 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:07:06 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:08:32 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:08:32 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:08:35 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:08:35 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:12:17 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:12:17 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:13:58 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:13:59 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:15:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:15:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:46 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:47 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:53 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:53 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:57 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:21:57 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:00 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:00 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:12 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:12 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:17 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:17 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:22:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:24:19 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:24:19 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:24:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:24:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:24:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:24:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:25:18 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:25:18 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:25:26 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:25:26 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:32:12 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:32:12 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:33:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:33:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:35:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:35:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:36:42 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:36:42 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:36:46 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:36:46 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:37:29 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:37:29 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:37:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:37:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:37:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:37:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:38:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:38:21 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:38:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:38:33 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:39:30 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:39:30 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:40:57 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:40:57 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:42:52 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:42:52 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:43:27 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:43:27 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:43:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:43:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:43:56 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:43:56 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:44:02 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:44:02 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:44:14 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:44:14 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:45:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:45:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:45:54 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:45:54 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 11:46:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:46:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:46:08 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:46:08 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:46:19 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_kontrol&quot; of relation &quot;xi_sa_kontrol&quot; violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, primaaulia, 2022-02-24 11:46:19, ::1, primaaulia, 2022-02-24 11:46:19, ::1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:46:19 --> Query error: ERROR:  null value in column "id_kontrol" of relation "xi_sa_kontrol" violates not-null constraint
DETAIL:  Failing row contains (null, test, test, test, test, primaaulia, 2022-02-24 11:46:19, ::1, primaaulia, 2022-02-24 11:46:19, ::1, 1). - Invalid query: INSERT INTO "xi_sa_kontrol" ("nama_kontrol", "label_kontrol", "url_kontrol", "deskripsi_kontrol", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('test', 'test', 'test', 'test', 'primaaulia', '2022-02-24 11:46:19', '::1', 'primaaulia', '2022-02-24 11:46:19', '::1', '1')
ERROR - 2022-02-24 11:48:05 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:48:05 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:48:18 --> Severity: Warning --> pg_query(): Query failed: ERROR:  duplicate key value violates unique constraint &quot;xi_sa_kontrol_pkey&quot;
DETAIL:  Key (id_kontrol)=(7) already exists. D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:48:18 --> Query error: ERROR:  duplicate key value violates unique constraint "xi_sa_kontrol_pkey"
DETAIL:  Key (id_kontrol)=(7) already exists. - Invalid query: INSERT INTO "xi_sa_kontrol" ("nama_kontrol", "label_kontrol", "url_kontrol", "deskripsi_kontrol", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('test', 'test', 'test', 'test', 'primaaulia', '2022-02-24 11:48:18', '::1', 'primaaulia', '2022-02-24 11:48:18', '::1', '1')
ERROR - 2022-02-24 11:48:37 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:48:37 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:50:45 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:50:45 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:51:43 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:51:43 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:51:46 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:51:46 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:52:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:52:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:53:35 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:53:35 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:54:18 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:54:18 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:54:40 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_rules&quot; of relation &quot;xi_sa_rules&quot; violates not-null constraint
DETAIL:  Failing row contains (null, 4, 1, 1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 11:54:40 --> Query error: ERROR:  null value in column "id_rules" of relation "xi_sa_rules" violates not-null constraint
DETAIL:  Failing row contains (null, 4, 1, 1, 1). - Invalid query: INSERT INTO "xi_sa_rules" ("id_module", "id_kontrol", "id_fungsi", "id_status") VALUES ('4', '1', '1', '1')
ERROR - 2022-02-24 11:56:03 --> 404 Page Not Found: /index
ERROR - 2022-02-24 11:56:03 --> 404 Page Not Found: /index
ERROR - 2022-02-24 12:00:58 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_group_privileges&quot; of relation &quot;xi_sa_group_privileges&quot; violates not-null constraint
DETAIL:  Failing row contains (null, 5, 1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 12:00:58 --> Query error: ERROR:  null value in column "id_group_privileges" of relation "xi_sa_group_privileges" violates not-null constraint
DETAIL:  Failing row contains (null, 5, 1, 1). - Invalid query: INSERT INTO "xi_sa_group_privileges" ("id_group", "id_rules", "id_status") VALUES ('5', '1', 1)
ERROR - 2022-02-24 12:01:01 --> 404 Page Not Found: /index
ERROR - 2022-02-24 12:01:01 --> 404 Page Not Found: /index
ERROR - 2022-02-24 12:01:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 12:01:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 12:01:09 --> Severity: Warning --> pg_query(): Query failed: ERROR:  null value in column &quot;id_group_privileges&quot; of relation &quot;xi_sa_group_privileges&quot; violates not-null constraint
DETAIL:  Failing row contains (null, 5, 1, 1). D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 12:01:09 --> Query error: ERROR:  null value in column "id_group_privileges" of relation "xi_sa_group_privileges" violates not-null constraint
DETAIL:  Failing row contains (null, 5, 1, 1). - Invalid query: INSERT INTO "xi_sa_group_privileges" ("id_group", "id_rules", "id_status") VALUES ('5', '1', 1)
ERROR - 2022-02-24 12:02:43 --> 404 Page Not Found: /index
ERROR - 2022-02-24 12:02:43 --> 404 Page Not Found: /index
ERROR - 2022-02-24 12:02:52 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp7\htdocs\clear-engine\application\modules\manajemen\models\Model_group.php 210
ERROR - 2022-02-24 15:07:05 --> Severity: Warning --> count(): Parameter must be an array or an object that implements Countable D:\xampp7\htdocs\clear-engine\application\modules\auth\models\Model_auth_signin.php 184
ERROR - 2022-02-24 15:07:41 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp7\htdocs\clear-engine\application\modules\manajemen\models\Model_group.php 210
ERROR - 2022-02-24 15:09:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:09:23 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:09:29 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:09:29 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:12:01 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp7\htdocs\clear-engine\application\modules\manajemen\models\Model_group.php 210
ERROR - 2022-02-24 15:15:23 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:15:23 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:16:11 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:16:11 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:26:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:26:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:27:45 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp7\htdocs\clear-engine\application\modules\manajemen\models\Model_group.php 210
ERROR - 2022-02-24 15:28:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:28:09 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:28:21 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp7\htdocs\clear-engine\application\modules\manajemen\models\Model_group.php 210
ERROR - 2022-02-24 15:30:16 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:30:16 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:30:33 --> Severity: Warning --> Invalid argument supplied for foreach() D:\xampp7\htdocs\clear-engine\application\modules\manajemen\models\Model_group.php 210
ERROR - 2022-02-24 15:33:59 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:33:59 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:35:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:35:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:36:07 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:38:37 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 4: AND &quot;parent_id&quot; = ''
                          ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 15:38:37 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 4: AND "parent_id" = ''
                          ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_menu"
WHERE "order_menu" = '6'
AND "parent_id" = ''
ERROR - 2022-02-24 15:38:40 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:38:40 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:38:44 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:38:45 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 4: AND &quot;parent_id&quot; = ''
                          ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 15:39:22 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 4: AND "parent_id" = ''
                          ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_menu"
WHERE "order_menu" = '11'
AND "parent_id" = ''
ERROR - 2022-02-24 15:39:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:25 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:39 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:46 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:46 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:53 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:39:53 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:41:40 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:41:40 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:42:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:42:20 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:43:31 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:43:31 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:44:02 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:44:02 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:44:42 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:44:42 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:46:50 --> 404 Page Not Found: /index
ERROR - 2022-02-24 15:46:51 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:15:35 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:15:35 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:18:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:18:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:19:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:19:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:21:41 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:21:41 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:25:13 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:25:13 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:27:07 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:27:07 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:27:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 4: AND &quot;parent_id&quot; = ''
                          ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 16:27:22 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 4: AND "parent_id" = ''
                          ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_menu"
WHERE "order_menu" = '12'
AND "parent_id" = ''
ERROR - 2022-02-24 16:27:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:27:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:28:07 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 4: AND &quot;parent_id&quot; = ''
                          ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 16:28:07 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 4: AND "parent_id" = ''
                          ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_menu"
WHERE "order_menu" = '12'
AND "parent_id" = ''
ERROR - 2022-02-24 16:31:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:31:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:32:48 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:32:49 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:35:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:35:22 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:36:02 --> Severity: Warning --> pg_query(): Query failed: ERROR:  invalid input syntax for type smallint: &quot;&quot;
LINE 4: AND &quot;parent_id&quot; = ''
                          ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 16:36:02 --> Query error: ERROR:  invalid input syntax for type smallint: ""
LINE 4: AND "parent_id" = ''
                          ^ - Invalid query: SELECT COUNT(*) AS "numrows"
FROM "xi_sa_menu"
WHERE "order_menu" = '45'
AND "parent_id" = ''
ERROR - 2022-02-24 16:36:52 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:36:53 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:37:10 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column &quot;id_rules&quot; is of type smallint but expression is of type boolean
LINE 1: ...tus&quot;) VALUES ('dfd', '', 'fas fa-file-alt', '23', FALSE, '2'...
                                                             ^
HINT:  You will need to rewrite or cast the expression. D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 16:37:10 --> Query error: ERROR:  column "id_rules" is of type smallint but expression is of type boolean
LINE 1: ...tus") VALUES ('dfd', '', 'fas fa-file-alt', '23', FALSE, '2'...
                                                             ^
HINT:  You will need to rewrite or cast the expression. - Invalid query: INSERT INTO "xi_sa_menu" ("title_menu", "url_menu", "icon_menu", "order_menu", "id_rules", "parent_id", "is_parent", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip", "id_status") VALUES ('dfd', '', 'fas fa-file-alt', '23', FALSE, '2', 'N', 'primaaulia', '2022-02-24 16:37:10', '::1', 'primaaulia', '2022-02-24 16:37:10', '::1', '1')
ERROR - 2022-02-24 16:42:56 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:42:56 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:43:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:43:24 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:44:49 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:44:49 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:45:03 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:45:03 --> 404 Page Not Found: /index
ERROR - 2022-02-24 16:50:06 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 16:50:06 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 17:01:51 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 17:01:51 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 17:01:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:01:54 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:02:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:02:04 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:02:04 --> Severity: Warning --> pg_query(): Query failed: ERROR:  syntax error at or near &quot;SEPARATOR&quot;
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 17:02:04 --> Query error: ERROR:  syntax error at or near "SEPARATOR"
LINE 4: ...CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ...
                                                             ^ - Invalid query: SELECT "a"."id_users", "a"."token", "a"."unit_id", "a"."username", "a"."email", "a"."fullname", "a"."foto_profile", "a"."blokir", "a"."id_status", "a"."unit_id_name", (CASE
                               WHEN d.pass_plain IS NULL THEN "-"
                               ELSE d.pass_plain
                           END) AS pass_plain, GROUP_CONCAT(c.nama_group ORDER BY c.id_level_akses ASC SEPARATOR ", ") AS group_user
FROM "xi_sa_users" "a"
LEFT JOIN "xi_sa_users_privileges" "b" ON "a"."id_users" = "b"."id_users"
LEFT JOIN "xi_sa_group" "c" ON "b"."id_group" = "c"."id_group"
LEFT JOIN "xi_sa_users_default_pass" "d" ON "a"."id_users" = "d"."id_users"
WHERE "b"."id_status" = 1
GROUP BY "a"."id_users"
ORDER BY "a"."id_users" ASC
 LIMIT 10
ERROR - 2022-02-24 17:05:23 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:05:23 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:10:01 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:10:01 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:11:01 --> Severity: Warning --> pg_query(): Query failed: ERROR:  duplicate key value violates unique constraint &quot;xi_sa_users_pkey&quot;
DETAIL:  Key (id_users)=(1) already exists. D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 17:11:01 --> Query error: ERROR:  duplicate key value violates unique constraint "xi_sa_users_pkey"
DETAIL:  Key (id_users)=(1) already exists. - Invalid query: INSERT INTO "xi_sa_users" ("token", "unit_id", "unit_id_name", "username", "password", "email", "fullname", "foto_profile", "blokir", "id_status", "validate_email_code", "validate_email_status", "reset_password_code", "reset_password_status", "reset_password_expired", "create_by", "create_date", "create_ip", "mod_by", "mod_date", "mod_ip") VALUES ('1C28B2DEB5F25511D7C5F2F0DE8EEF5B', '0', '', 'test1234', '$2a$12$YRaTYpILYIzk4DMfrut2keUbxflGKnvD3HOrB/lLbRG9GLLmv66J6', '', 'test', 'default-user-icon.jpg', '0', '1', '', 0, '', 0, 0, 'primaaulia', '2022-02-24 17:11:01', '::1', 'primaaulia', '2022-02-24 17:11:01', '::1')
ERROR - 2022-02-24 17:11:30 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:11:30 --> 404 Page Not Found: /index
ERROR - 2022-02-24 17:11:41 --> Severity: Warning --> pg_query(): Query failed: ERROR:  duplicate key value violates unique constraint &quot;xi_sa_users_privileges_pkey&quot;
DETAIL:  Key (id_users_privileges)=(2) already exists. D:\xampp7\htdocs\clear-engine\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2022-02-24 17:11:41 --> Query error: ERROR:  duplicate key value violates unique constraint "xi_sa_users_privileges_pkey"
DETAIL:  Key (id_users_privileges)=(2) already exists. - Invalid query: INSERT INTO "xi_sa_users_privileges" ("id_users", "id_group", "id_status") VALUES (3, '1', 1)
