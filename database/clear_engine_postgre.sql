/*
 Navicat Premium Data Transfer

 Source Server         : Lokal_Postgree
 Source Server Type    : PostgreSQL
 Source Server Version : 150002 (150002)
 Source Host           : localhost:5432
 Source Catalog        : clear_engine
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 150002 (150002)
 File Encoding         : 65001

 Date: 13/09/2023 16:12:45
*/


-- ----------------------------
-- Type structure for breakpoint
-- ----------------------------
DROP TYPE IF EXISTS "public"."breakpoint";
CREATE TYPE "public"."breakpoint" AS (
  "func" oid,
  "linenumber" int4,
  "targetname" text COLLATE "pg_catalog"."default"
);
ALTER TYPE "public"."breakpoint" OWNER TO "postgres";

-- ----------------------------
-- Type structure for frame
-- ----------------------------
DROP TYPE IF EXISTS "public"."frame";
CREATE TYPE "public"."frame" AS (
  "level" int4,
  "targetname" text COLLATE "pg_catalog"."default",
  "func" oid,
  "linenumber" int4,
  "args" text COLLATE "pg_catalog"."default"
);
ALTER TYPE "public"."frame" OWNER TO "postgres";

-- ----------------------------
-- Type structure for proxyinfo
-- ----------------------------
DROP TYPE IF EXISTS "public"."proxyinfo";
CREATE TYPE "public"."proxyinfo" AS (
  "serverversionstr" text COLLATE "pg_catalog"."default",
  "serverversionnum" int4,
  "proxyapiver" int4,
  "serverprocessid" int4
);
ALTER TYPE "public"."proxyinfo" OWNER TO "postgres";

-- ----------------------------
-- Type structure for targetinfo
-- ----------------------------
DROP TYPE IF EXISTS "public"."targetinfo";
CREATE TYPE "public"."targetinfo" AS (
  "target" oid,
  "schema" oid,
  "nargs" int4,
  "argtypes" "pg_catalog"."oidvector",
  "targetname" "pg_catalog"."name" COLLATE "pg_catalog"."C",
  "argmodes" "char"[],
  "argnames" text[] COLLATE "pg_catalog"."default",
  "targetlang" oid,
  "fqname" text COLLATE "pg_catalog"."default",
  "returnsset" bool,
  "returntype" oid,
  "isfunc" bool,
  "pkg" oid,
  "argdefvals" text[] COLLATE "pg_catalog"."default"
);
ALTER TYPE "public"."targetinfo" OWNER TO "postgres";

-- ----------------------------
-- Type structure for var
-- ----------------------------
DROP TYPE IF EXISTS "public"."var";
CREATE TYPE "public"."var" AS (
  "name" text COLLATE "pg_catalog"."default",
  "varclass" char(1) COLLATE "pg_catalog"."default",
  "linenumber" int4,
  "isunique" bool,
  "isconst" bool,
  "isnotnull" bool,
  "dtype" oid,
  "value" text COLLATE "pg_catalog"."default"
);
ALTER TYPE "public"."var" OWNER TO "postgres";

-- ----------------------------
-- Sequence structure for ac_xi_sa_fungsi
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_fungsi";
CREATE SEQUENCE "public"."ac_xi_sa_fungsi" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_group
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_group";
CREATE SEQUENCE "public"."ac_xi_sa_group" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 3
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_group_privileges
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_group_privileges";
CREATE SEQUENCE "public"."ac_xi_sa_group_privileges" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_jenis_fungsi
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_jenis_fungsi";
CREATE SEQUENCE "public"."ac_xi_sa_jenis_fungsi" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_kontrol
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_kontrol";
CREATE SEQUENCE "public"."ac_xi_sa_kontrol" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_level_akses
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_level_akses";
CREATE SEQUENCE "public"."ac_xi_sa_level_akses" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_log_login
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_log_login";
CREATE SEQUENCE "public"."ac_xi_sa_log_login" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_log_session
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_log_session";
CREATE SEQUENCE "public"."ac_xi_sa_log_session" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_menu
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_menu";
CREATE SEQUENCE "public"."ac_xi_sa_menu" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_module
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_module";
CREATE SEQUENCE "public"."ac_xi_sa_module" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_rules
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_rules";
CREATE SEQUENCE "public"."ac_xi_sa_rules" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_users
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_users";
CREATE SEQUENCE "public"."ac_xi_sa_users" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_users_default_pass
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_users_default_pass";
CREATE SEQUENCE "public"."ac_xi_sa_users_default_pass" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_users_privileges
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_users_privileges";
CREATE SEQUENCE "public"."ac_xi_sa_users_privileges" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for ac_xi_sa_white_list
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."ac_xi_sa_white_list";
CREATE SEQUENCE "public"."ac_xi_sa_white_list" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for xi_sa_ci_session
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_ci_session";
CREATE TABLE "public"."xi_sa_ci_session" (
  "id" varchar(128) COLLATE "pg_catalog"."default" NOT NULL,
  "ip_address" varchar(45) COLLATE "pg_catalog"."default" NOT NULL,
  "timestamp" int4 NOT NULL,
  "data" text COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_ci_session
-- ----------------------------
INSERT INTO "public"."xi_sa_ci_session" VALUES ('hvm2jjhfip87rmfv4tlra6tsg8d06i07', '127.0.0.1', 1643163945, 'account_name|s:10:"primaaulia";AppTppOnline@2020session|s:192:"6b2c8aa5b02ef9a850b6191db0bcf94f1426a28a5dde60e038115caf462de67fe544e7fe39056ae3d6df1a3350d4b06ad063876322006d5661d92b608fc01c30dQUWc97PL+AZMOepDKLkvSOLKUY0w5OQiSK/Ob4XO708eu40Mz5TMF0R1uZhNXev";expires_by|i:1643163838;fullname|s:11:"Prima Aulia";group_active|s:1:"1";group_name|s:11:"Super Admin";level_akses|s:11:"SUPER ADMIN";nick_level|s:3:"SAD";user_id|s:32:"4A3729CA5A1593D72E67FF0FE31185D1";unit_id|s:1:"0";unit_id_name|s:0:"";');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('i9avmspa7c644pi48m04ad25o611j8hd', '127.0.0.1', 1643096642, 'fullname|s:11:"Prima Aulia";unit_id_name|s:0:"";');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('74uci0afmavah9mudca0u168kaoaeqoo', '::1', 1694424044, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NDI0MDM3O2FjY291bnRfbmFtZXxzOjEwOiJwcmltYWF1bGlhIjtjbGVhcjNuZ2luZTIwMjJ8czoxOTI6IjliYWI5NjhkZTQzNmRiZGJiYTkzMzVlYTEzMTBmNjM1ZDhlMjA1MGNkNzVjYWQxNjkwNGI5MTYwYWJkYzMzNGNlNmRjMmUwZDE0NmUyMmM4MzFkODE3NzJlYjk1MzQwNDk5OTA3Y2I4YjI3NGM1YTVmN2IyMjQxNDI0MmNjNmNmbXdYeFNSWkFKa2RXTHJnWXFLOXc0SXpqaHMzczNFcnBabHNhUHhUN2xBVjc1NHZSUTBrT3YrWXR3cjZra0JrTCI7ZXhwaXJlc19ieXxpOjE2OTQ0Mjc2NDQ7ZnVsbG5hbWV8czoxMToiUHJpbWEgQXVsaWEiO2dyb3VwX2FjdGl2ZXxzOjE6IjEiO2dyb3VwX25hbWV8czoxMToiU3VwZXIgQWRtaW4iO2xldmVsX2Frc2VzfHM6MTE6IlNVUEVSIEFETUlOIjtuaWNrX2xldmVsfHM6MzoiU0FEIjt1c2VyX2lkfHM6MzI6IjRBMzcyOUNBNUExNTkzRDcyRTY3RkYwRkUzMTE4NUQxIjt1bml0X2lkfHM6MToiMCI7dW5pdF9pZF9uYW1lfHM6MDoiIjs=');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('e7oscl6a9fr0mr9u96ic08of95c9rntm', '::1', 1694484929, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NDg0OTI5O2FjY291bnRfbmFtZXxzOjEwOiJwcmltYWF1bGlhIjtjbGVhcjNuZ2luZTIwMjJ8czoxOTI6IjJhYTk1MDdmNDc1OGYxYzg4N2JlNTY0ODliOTAzNTY2NDdmNGM4Nzc4ZGY5MzdiYmJiZWVhMTU2MGJjYWIyNGMzODg5MTI0ZmVjOWZmNjRiNzM3NTI4OGE4Y2UyOWZlNWM1NDFkZTA4ODM2ZTcyMTcwYmIxMGUxYTY1MzQ4OThkaC8zTnVrRXM0c1NxTlZSSEpqMStjL1R2ME4xMlRWQy96YnpKelZsL3IwNllnZGoyajBRWklmdG0vSlZXOVRIOSI7ZXhwaXJlc19ieXxpOjE2OTQ0ODc5OTI7ZnVsbG5hbWV8czoxMToiUHJpbWEgQXVsaWEiO2dyb3VwX2FjdGl2ZXxzOjE6IjEiO2dyb3VwX25hbWV8czoxMToiU3VwZXIgQWRtaW4iO2xldmVsX2Frc2VzfHM6MTE6IlNVUEVSIEFETUlOIjtuaWNrX2xldmVsfHM6MzoiU0FEIjt1c2VyX2lkfHM6MzI6IjRBMzcyOUNBNUExNTkzRDcyRTY3RkYwRkUzMTE4NUQxIjt1bml0X2lkfHM6MToiMCI7dW5pdF9pZF9uYW1lfHM6MDoiIjs=');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('mbec4lp4sa6c1po3a50mghla3il0c8n5', '::1', 1694484943, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NDg0OTI5O2Z1bGxuYW1lfHM6MTE6IlByaW1hIEF1bGlhIjt1bml0X2lkX25hbWV8czowOiIiO2FjY291bnRfbmFtZXxzOjEwOiJwcmltYWF1bGlhIjtjbGVhcjNuZ2luZTIwMjJ8czoxOTI6Ijg0ZTk1NTgxYWE5NWUyMGIwNWY0MzZkN2U0ZDQyOTNmMzI3ZjUzNWYxZWZmNjRkY2VjMzk0NDgyMjJmNzJjNWFmZDc2MzA5MTI5YTEzMGE4YzcyNzk1MDcxNzFkMTkwMDg3MTgwZDc5Mjg0N2EyZGViYWRkZjAwODJiZDEzNWZjMmlDRDRIMVhQVUhOckJrMHVwaEFnclEzdjBMVG1TVG50akV3eHJmUzNmUmE4N1FLa0tHSlZ5RUsyLzhiNDhTdyI7ZXhwaXJlc19ieXxpOjE2OTQ0ODg1Mzk7Z3JvdXBfYWN0aXZlfHM6MToiMSI7Z3JvdXBfbmFtZXxzOjExOiJTdXBlciBBZG1pbiI7bGV2ZWxfYWtzZXN8czoxMToiU1VQRVIgQURNSU4iO25pY2tfbGV2ZWx8czozOiJTQUQiO3VzZXJfaWR8czozMjoiNEEzNzI5Q0E1QTE1OTNENzJFNjdGRjBGRTMxMTg1RDEiO3VuaXRfaWR8czoxOiIwIjs=');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('9dqpkuaqdbsljtkmej6luc222ui1o6q7', '::1', 1694594798, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NTk0Nzk4Ow==');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('cmvgv82v5rc07abrfkhhliul0e0vnshh', '::1', 1694596235, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NTk1OTg1O2FjY291bnRfbmFtZXxzOjEwOiJwcmltYWF1bGlhIjtjbGVhcjNuZ2luZTIwMjJ8czoxOTI6ImMwYjRiZTY2ZGYzYzY5ZDJmMWVkZTY1NjExY2NhN2UxOTZjOWVkNzBiMWU2OGIwZGM2NGM4MjhiOTkzYmY3ZGU5NjFhZjNhYjgyNmY0NDdkNTE0MjVlZjhlODZjMmQ1ZmM5MjdkZjAwNjg0ZDQ1MjkxNGQ1MjFlNmFkYzJhMWY4bUltWkppQXZrQnk3bkFidHFnWnI1OUdRLzBZbzVjS3VQbmR5VHp0WEFqRWt5NDVFaUxoOVdGencxTWU1Q1dFWCI7ZXhwaXJlc19ieXxpOjE2OTQ1OTkxMDU7ZnVsbG5hbWV8czoxMToiUHJpbWEgQXVsaWEiO2dyb3VwX2FjdGl2ZXxzOjE6IjEiO2dyb3VwX25hbWV8czoxMToiU3VwZXIgQWRtaW4iO2xldmVsX2Frc2VzfHM6MTE6IlNVUEVSIEFETUlOIjtuaWNrX2xldmVsfHM6MzoiU0FEIjt1c2VyX2lkfHM6MzI6IjRBMzcyOUNBNUExNTkzRDcyRTY3RkYwRkUzMTE4NUQxIjt1bml0X2lkfHM6MToiMCI7dW5pdF9pZF9uYW1lfHM6MDoiIjs=');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('9a9livkm05b41bm665im52qf0k6rc2d6', '::1', 1694595985, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NTk1OTg1O2FjY291bnRfbmFtZXxzOjEwOiJwcmltYWF1bGlhIjtjbGVhcjNuZ2luZTIwMjJ8czoxOTI6ImMwYjRiZTY2ZGYzYzY5ZDJmMWVkZTY1NjExY2NhN2UxOTZjOWVkNzBiMWU2OGIwZGM2NGM4MjhiOTkzYmY3ZGU5NjFhZjNhYjgyNmY0NDdkNTE0MjVlZjhlODZjMmQ1ZmM5MjdkZjAwNjg0ZDQ1MjkxNGQ1MjFlNmFkYzJhMWY4bUltWkppQXZrQnk3bkFidHFnWnI1OUdRLzBZbzVjS3VQbmR5VHp0WEFqRWt5NDVFaUxoOVdGencxTWU1Q1dFWCI7ZXhwaXJlc19ieXxpOjE2OTQ1OTkxMDU7ZnVsbG5hbWV8czoxMToiUHJpbWEgQXVsaWEiO2dyb3VwX2FjdGl2ZXxzOjE6IjEiO2dyb3VwX25hbWV8czoxMToiU3VwZXIgQWRtaW4iO2xldmVsX2Frc2VzfHM6MTE6IlNVUEVSIEFETUlOIjtuaWNrX2xldmVsfHM6MzoiU0FEIjt1c2VyX2lkfHM6MzI6IjRBMzcyOUNBNUExNTkzRDcyRTY3RkYwRkUzMTE4NUQxIjt1bml0X2lkfHM6MToiMCI7dW5pdF9pZF9uYW1lfHM6MDoiIjs=');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('g512p18m0kk980ujk0bkur4hitcaom8r', '::1', 1694595099, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NTk1MDk5Ow==');
INSERT INTO "public"."xi_sa_ci_session" VALUES ('mv1nuj6kqg8usd6v6al25hhotnf3h7pl', '::1', 1694595422, 'X19jaV9sYXN0X3JlZ2VuZXJhdGV8aToxNjk0NTk1NDIyOw==');

-- ----------------------------
-- Table structure for xi_sa_fungsi
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_fungsi";
CREATE TABLE "public"."xi_sa_fungsi" (
  "id_fungsi" int2 NOT NULL DEFAULT nextval('ac_xi_sa_fungsi'::regclass),
  "nama_fungsi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "label_fungsi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "url_fungsi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "deskripsi_fungsi" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "id_jenis_fungsi" int2 NOT NULL,
  "id_level_akses" int2,
  "create_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "create_date" timestamp(6) NOT NULL,
  "create_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_date" timestamp(6) NOT NULL,
  "mod_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_fungsi
-- ----------------------------
INSERT INTO "public"."xi_sa_fungsi" VALUES (1, 'index', 'Index', 'index', 'Fungsi untuk menampilkan data', 1, 0, 'yogisolop', '2017-06-04 19:30:40', '::1', 'yogisolop', '2020-08-28 11:45:59', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (2, 'create', 'Create Data', 'create', 'Fungsi untuk menambahkan data', 2, 0, 'yogisolop', '2017-06-04 19:32:33', '::1', 'yogisolop', '2017-09-05 17:52:35', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (3, 'update', 'Update Data', 'update', 'Fungsi untuk merubah data', 2, 0, 'yogisolop', '2017-06-04 19:33:01', '::1', 'yogisolop', '2017-09-05 17:52:44', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (4, 'delete', 'Delete Data', 'delete', 'Fungsi untuk menghapus data', 2, 0, 'yogisolop', '2017-06-04 19:33:33', '::1', 'yogisolop', '2017-09-05 17:52:52', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (5, 'listview', 'List View Data', 'listview', 'Fungsi untuk menampilkan list data', 2, 0, 'yogisolop', '2017-11-06 13:59:43', '::1', 'yogisolop', '2017-11-06 13:59:43', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (6, 'review', 'Review Data', 'review', 'Fungsi untuk mereview data kembali', 2, 0, 'yogisolop', '2017-12-17 23:45:14', '::1', 'yogisolop', '2017-12-17 23:45:29', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (7, 'details', 'Data Details', 'details', 'Fungsi untuk melihat rincian data', 2, 0, 'yogisolop', '2017-12-27 08:28:13', '::1', 'yogisolop', '2017-12-27 08:28:13', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (8, 'searching', 'Searching', 'searching', 'Fungsi untuk mencari data', 2, 0, 'yogisolop', '2017-11-07 13:21:59', '::1', 'yogisolop', '2017-11-07 13:21:59', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (9, 'rules', 'Rules Module', 'rules', 'Fungsi untuk setting rules module', 2, 0, 'yogisolop', '2017-06-05 10:51:09', '::1', 'yogisolop', '2020-04-07 22:38:12', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (10, 'privileges', 'Group Privilege', 'privileges', 'Fungsi untuk setting group privilege', 2, 0, 'yogisolop', '2017-06-10 22:23:24', '::1', 'yogisolop', '2017-08-03 12:20:22', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (11, 'regency', 'Data Regency', 'regency', 'Fungsi untuk mengambil data regency', 2, 0, 'yogisolop', '2020-04-11 22:38:38', '::1', 'yogisolop', '2020-04-11 22:38:38', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (12, 'district', 'Data District', 'district', 'Fungsi untuk mengambil data district', 2, 0, 'yogisolop', '2020-04-11 22:39:48', '::1', 'yogisolop', '2020-04-11 22:39:48', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (13, 'village', 'Data Village', 'village', 'Fungsi untuk mengambil data village', 2, 0, 'yogisolop', '2020-04-11 22:40:11', '::1', 'yogisolop', '2020-04-11 22:40:11', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (14, 'approve', 'Data Approve', 'approve', 'Fungsi untuk menyetujui data', 2, 0, 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (15, 'reject', 'Data Reject', 'reject', 'Fungsi untuk menolak data', 2, 0, 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 'yogisolop', '2018-04-03 09:22:12', '36.67.167.61', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (16, 'upload', 'Upload Data', 'upload', 'Fungsi untuk mengupload file', 2, 0, 'yogisolop', '2018-07-24 22:20:18', '::1', 'yogisolop', '2018-08-03 15:09:33', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (17, 'download', 'Download Data', 'download', 'Fungsi untuk mendownload file', 2, 0, 'yogisolop', '2018-07-24 22:21:04', '::1', 'yogisolop', '2018-08-03 15:09:42', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (18, 'export_to_word', 'Download Word', 'export-to-word', 'Fungsi download laporan format word', 2, 0, 'yogisolop', '2020-05-02 07:16:39', '::1', 'yogisolop', '2020-05-22 08:03:33', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (19, 'export_to_excel', 'Download Excel', 'export-to-excel', 'Fungsi download laporan format excel', 2, 0, 'yogisolop', '2020-05-11 08:27:30', '::1', 'yogisolop', '2020-05-11 08:27:30', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (20, 'export_to_pdf', 'Download PDF', 'export-to-pdf', 'Fungsi download laporan format pdf', 2, 0, 'yogisolop', '2020-05-11 08:30:42', '::1', 'yogisolop', '2020-05-11 08:30:42', '::1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (25, 'getOptionOpd', 'Get Option OPD', 'getOptionOpd', 'untuk memanggil option data opd dari API Simpeg', 2, 0, 'primaaulia', '2021-03-25 09:22:37', '127.0.0.1', 'primaaulia', '2021-03-25 09:22:37', '127.0.0.1', 1);
INSERT INTO "public"."xi_sa_fungsi" VALUES (28, 'test', 'test', 'test', 'test', 1, NULL, 'primaaulia', '2023-09-12 09:06:56', '::1', 'primaaulia', '2023-09-12 09:06:56', '::1', 1);

-- ----------------------------
-- Table structure for xi_sa_group
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_group";
CREATE TABLE "public"."xi_sa_group" (
  "id_group" int2 NOT NULL DEFAULT nextval('ac_xi_sa_group'::regclass),
  "nama_group" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "id_level_akses" int2 NOT NULL,
  "id_upk" int2,
  "create_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "create_date" timestamp(6) NOT NULL,
  "create_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_date" timestamp(6) NOT NULL,
  "mod_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_group
-- ----------------------------
INSERT INTO "public"."xi_sa_group" VALUES (1, 'Super Admin', 1, 0, 'yogisolop', '2020-04-07 00:00:00', '::1', 'yogisolop', '2020-04-07 00:00:00', '::1', 1);
INSERT INTO "public"."xi_sa_group" VALUES (3, 'Admin OPD', 3, 0, 'yogisolop', '2020-09-20 12:39:02', '::1', 'primaaulia', '2021-03-24 11:43:00', '127.0.0.1', 1);

-- ----------------------------
-- Table structure for xi_sa_group_privileges
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_group_privileges";
CREATE TABLE "public"."xi_sa_group_privileges" (
  "id_group_privileges" int2 NOT NULL DEFAULT nextval('ac_xi_sa_group_privileges'::regclass),
  "id_group" int2 NOT NULL,
  "id_rules" int2 NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_group_privileges
-- ----------------------------
INSERT INTO "public"."xi_sa_group_privileges" VALUES (1, 1, 1, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (2, 1, 2, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (3, 1, 3, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (4, 1, 4, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (5, 1, 5, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (6, 1, 6, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (7, 1, 7, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (8, 1, 8, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (9, 1, 9, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (10, 1, 10, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (11, 1, 11, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (12, 1, 12, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (13, 1, 13, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (14, 1, 14, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (15, 1, 15, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (16, 1, 16, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (17, 1, 17, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (18, 1, 18, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (19, 1, 19, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (20, 1, 20, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (21, 1, 21, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (22, 1, 22, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (23, 1, 23, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (24, 1, 24, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (25, 1, 25, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (26, 1, 26, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (27, 1, 27, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (28, 1, 28, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (29, 1, 29, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (30, 1, 30, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (31, 1, 31, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (32, 1, 32, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (33, 1, 33, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (34, 1, 34, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (35, 1, 35, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (36, 1, 36, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (37, 1, 37, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (38, 1, 38, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (39, 1, 39, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (40, 1, 40, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (41, 1, 41, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (42, 1, 42, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (43, 1, 43, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (44, 1, 44, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (45, 1, 45, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (46, 1, 46, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (47, 1, 47, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (48, 1, 48, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (49, 1, 49, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (50, 1, 50, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (51, 1, 51, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (52, 1, 52, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (53, 1, 53, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (54, 1, 54, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (55, 1, 55, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (56, 1, 56, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (57, 1, 57, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (58, 1, 58, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (59, 1, 59, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (60, 1, 60, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (61, 1, 61, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (62, 1, 62, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (63, 1, 63, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (64, 1, 64, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (65, 1, 65, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (66, 1, 66, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (67, 1, 67, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (68, 1, 68, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (69, 1, 69, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (70, 1, 70, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (71, 1, 71, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (72, 1, 72, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (73, 1, 73, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (74, 1, 74, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (75, 1, 76, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (76, 1, 75, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (77, 1, 77, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (78, 1, 78, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (79, 1, 79, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (80, 1, 80, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (81, 1, 81, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (82, 1, 82, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (83, 1, 83, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (84, 1, 84, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (108, 1, 85, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (109, 1, 86, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (110, 1, 87, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (111, 1, 88, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (112, 1, 89, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (113, 1, 90, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (114, 1, 91, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (115, 1, 92, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (130, 1, 93, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (131, 1, 94, 1);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (132, 1, 95, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (133, 1, 96, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (134, 1, 97, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (135, 1, 98, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (136, 1, 99, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (137, 1, 100, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (138, 1, 101, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (139, 1, 102, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (140, 1, 103, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (141, 1, 104, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (142, 1, 105, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (143, 1, 106, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (144, 1, 107, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (145, 1, 108, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (146, 1, 109, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (147, 1, 110, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (148, 1, 112, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (149, 1, 113, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (160, 1, 114, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (161, 1, 115, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (162, 1, 116, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (163, 1, 117, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (164, 1, 118, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (165, 1, 119, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (166, 1, 120, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (180, 1, 135, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (181, 1, 136, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (182, 1, 137, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (183, 1, 138, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (184, 1, 139, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (185, 1, 140, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (186, 1, 141, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (187, 1, 142, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (188, 1, 121, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (189, 1, 122, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (190, 1, 127, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (191, 1, 129, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (192, 1, 130, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (193, 1, 131, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (194, 1, 128, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (195, 1, 132, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (196, 1, 134, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (197, 1, 143, 0);
INSERT INTO "public"."xi_sa_group_privileges" VALUES (199, 3, 1, 1);

-- ----------------------------
-- Table structure for xi_sa_jenis_fungsi
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_jenis_fungsi";
CREATE TABLE "public"."xi_sa_jenis_fungsi" (
  "id_jenis_fungsi" int2 NOT NULL DEFAULT nextval('ac_xi_sa_jenis_fungsi'::regclass),
  "jenis_fungsi" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_jenis_fungsi
-- ----------------------------
INSERT INTO "public"."xi_sa_jenis_fungsi" VALUES (1, 'Fungsi Public', 1);
INSERT INTO "public"."xi_sa_jenis_fungsi" VALUES (2, 'Fungsi Pendukung', 1);
INSERT INTO "public"."xi_sa_jenis_fungsi" VALUES (3, 'Fungsi Private', 1);
INSERT INTO "public"."xi_sa_jenis_fungsi" VALUES (4, 'Fungsi Belum Ada', 1);

-- ----------------------------
-- Table structure for xi_sa_kontrol
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_kontrol";
CREATE TABLE "public"."xi_sa_kontrol" (
  "id_kontrol" int2 NOT NULL DEFAULT nextval('ac_xi_sa_kontrol'::regclass),
  "nama_kontrol" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "label_kontrol" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "url_kontrol" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "deskripsi_kontrol" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "create_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "create_date" timestamp(6) NOT NULL,
  "create_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_date" timestamp(6) NOT NULL,
  "mod_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_kontrol
-- ----------------------------
INSERT INTO "public"."xi_sa_kontrol" VALUES (1, 'home', 'Home', 'home', 'Halaman dashboard', '', '2017-06-04 19:36:44', '::1', 'yogisolop', '2020-05-19 11:01:39', '::1', 1);
INSERT INTO "public"."xi_sa_kontrol" VALUES (2, 'fungsi', 'Fungsi', 'fungsi', 'Halaman manajamen fungsi', '', '2017-06-04 19:37:18', '::1', '', '2017-06-07 11:42:03', '::1', 1);
INSERT INTO "public"."xi_sa_kontrol" VALUES (3, 'kontrol', 'Kontrol', 'kontrol', 'Halaman manajemen kontrol', '', '2017-06-04 19:37:38', '::1', '', '2017-06-07 11:41:55', '::1', 1);
INSERT INTO "public"."xi_sa_kontrol" VALUES (4, 'module', 'Module', 'module', 'Halaman manajemen module', '', '2017-06-04 19:37:58', '::1', '', '2017-06-07 11:41:47', '::1', 1);
INSERT INTO "public"."xi_sa_kontrol" VALUES (5, 'menu', 'Menu', 'menu', 'Halaman majamen menu', '', '2017-06-07 11:41:18', '::1', '', '2017-06-07 11:41:18', '::1', 1);
INSERT INTO "public"."xi_sa_kontrol" VALUES (6, 'group', 'Group', 'group', 'Halaman manajemen group', '', '2017-06-10 22:23:53', '::1', '', '2017-06-10 22:24:15', '::1', 1);
INSERT INTO "public"."xi_sa_kontrol" VALUES (7, 'users', 'Users', 'users', 'Halaman manajemen users', '', '2017-06-14 19:18:54', '::1', '', '2017-06-14 19:19:06', '::1', 1);

-- ----------------------------
-- Table structure for xi_sa_level_akses
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_level_akses";
CREATE TABLE "public"."xi_sa_level_akses" (
  "id_level_akses" int2 NOT NULL DEFAULT nextval('ac_xi_sa_level_akses'::regclass),
  "level_akses" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "nick_level" char(3) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_level_akses
-- ----------------------------
INSERT INTO "public"."xi_sa_level_akses" VALUES (1, 'SUPER ADMIN', 'SAD', 1);
INSERT INTO "public"."xi_sa_level_akses" VALUES (2, 'ADMIN', 'ADM', 1);
INSERT INTO "public"."xi_sa_level_akses" VALUES (3, 'OPERATOR', 'OPR', 1);

-- ----------------------------
-- Table structure for xi_sa_log_login
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_log_login";
CREATE TABLE "public"."xi_sa_log_login" (
  "id_log" int2 NOT NULL DEFAULT nextval('ac_xi_sa_log_login'::regclass),
  "username" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "login_time" int4 NOT NULL,
  "ip_address" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "user_agent" varchar(200) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_log_login
-- ----------------------------

-- ----------------------------
-- Table structure for xi_sa_log_session
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_log_session";
CREATE TABLE "public"."xi_sa_log_session" (
  "id_log_session" int2 NOT NULL DEFAULT nextval('ac_xi_sa_log_session'::regclass),
  "id_users" int2 NOT NULL,
  "username" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "login_time" int4 NOT NULL,
  "ip_address" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "user_agent" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL,
  "session_id" varchar(255) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_log_session
-- ----------------------------
INSERT INTO "public"."xi_sa_log_session" VALUES (2, 2, 'primaaulia', 1694424044, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 1, '9bab968de436dbdbba9335ea1310f635d8e2050cd75cad16904b9160abdc334ce6dc2e0d146e22c831d81772eb95340499907cb8b274c5a5f7b22414242cc6cfmwXxSRZAJkdWLrgYqK9w4Izjhs3s3ErpZlsaPxT7lAV754vRQ0kOv+Ytwr6kkBkL');
INSERT INTO "public"."xi_sa_log_session" VALUES (3, 2, 'primaaulia', 1694484392, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 0, '2aa9507f4758f1c887be56489b90356647f4c8778df937bbbbeea1560bcab24c3889124fec9ff64b7375288a8ce29fe5c541de08836e72170bb10e1a6534898dh/3NukEs4sSqNVRHJj1+c/Tv0N12TVC/zbzJzVl/r06Ygdj2j0QZIftm/JVW9TH9');
INSERT INTO "public"."xi_sa_log_session" VALUES (4, 2, 'primaaulia', 1694484939, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 1, '84e95581aa95e20b05f436d7e4d4293f327f535f1eff64dcec39448222f72c5afd76309129a130a8c7279507171d190087180d792847a2debaddf0082bd135fc2iCD4H1XPUHNrBk0uphAgrQ3v0LTmSTntjEwxrfS3fRa87QKkKGJVyEK2/8b48Sw');
INSERT INTO "public"."xi_sa_log_session" VALUES (5, 2, 'primaaulia', 1694595505, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 1, 'c0b4be66df3c69d2f1ede65611cca7e196c9ed70b1e68b0dc64c828b993bf7de961af3ab826f447d51425ef8e86c2d5fc927df00684d452914d521e6adc2a1f8mImZJiAvkBy7nAbtqgZr59GQ/0Yo5cKuPndyTztXAjEky45EiLh9WFzw1Me5CWEX');

-- ----------------------------
-- Table structure for xi_sa_menu
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_menu";
CREATE TABLE "public"."xi_sa_menu" (
  "id_menu" int2 NOT NULL DEFAULT nextval('ac_xi_sa_menu'::regclass),
  "title_menu" varchar(55) COLLATE "pg_catalog"."default" NOT NULL,
  "url_menu" varchar(55) COLLATE "pg_catalog"."default" NOT NULL,
  "icon_menu" varchar(55) COLLATE "pg_catalog"."default" NOT NULL,
  "order_menu" int2 NOT NULL,
  "id_rules" int2 NOT NULL,
  "parent_id" int2 NOT NULL,
  "is_parent" varchar(55) COLLATE "pg_catalog"."default" NOT NULL,
  "create_by" varchar(55) COLLATE "pg_catalog"."default" NOT NULL,
  "create_date" timestamp(6) NOT NULL,
  "create_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_by" varchar(55) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_date" timestamp(6) NOT NULL,
  "mod_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_menu
-- ----------------------------
INSERT INTO "public"."xi_sa_menu" VALUES (1, 'Home', '', 'fas fa-home', 1, 1, 0, 'N', '', '2017-06-07 12:09:31', '::1', 'yogisolop', '2020-09-17 20:00:32', '::1', 1);
INSERT INTO "public"."xi_sa_menu" VALUES (2, 'Manajemen', '#', 'fas fa-user-cog', 2, 0, 0, 'Y', '', '2017-06-07 12:09:47', '::1', 'yogisolop', '2019-04-23 14:32:10', '36.67.76.99', 1);
INSERT INTO "public"."xi_sa_menu" VALUES (3, 'Fungsi', '', '', 1, 2, 2, 'N', '', '2017-06-07 12:10:03', '::1', 'yogisolop', '2019-04-23 14:32:04', '36.67.76.99', 1);
INSERT INTO "public"."xi_sa_menu" VALUES (4, 'Kontrol', '', '', 2, 8, 2, 'N', '', '2017-06-07 12:10:26', '::1', 'yogisolop', '2019-04-23 14:32:20', '36.67.76.99', 1);
INSERT INTO "public"."xi_sa_menu" VALUES (5, 'Module', '', '', 3, 14, 2, 'N', '', '2017-06-07 12:10:48', '::1', 'yogisolop', '2019-04-23 14:32:26', '36.67.76.99', 1);
INSERT INTO "public"."xi_sa_menu" VALUES (6, 'Menu', '', '', 5, 21, 2, 'N', '', '2017-06-07 12:11:06', '::1', 'yogisolop', '2020-09-24 08:52:06', '::1', 1);
INSERT INTO "public"."xi_sa_menu" VALUES (7, 'Group', '', '', 4, 27, 2, 'N', '', '2017-06-10 22:25:19', '::1', 'yogisolop', '2020-09-24 08:52:14', '::1', 1);
INSERT INTO "public"."xi_sa_menu" VALUES (8, 'Users', '', '', 6, 34, 2, 'N', '', '2017-06-14 19:20:01', '::1', 'yogisolop', '2019-04-23 14:32:44', '36.67.76.99', 1);

-- ----------------------------
-- Table structure for xi_sa_module
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_module";
CREATE TABLE "public"."xi_sa_module" (
  "id_module" int2 NOT NULL DEFAULT nextval('ac_xi_sa_module'::regclass),
  "nama_module" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "label_module" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "url_module" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "deskripsi_module" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "create_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "create_date" timestamp(6) NOT NULL,
  "create_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_date" timestamp(6) NOT NULL,
  "mod_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_module
-- ----------------------------
INSERT INTO "public"."xi_sa_module" VALUES (1, 'home', 'Home', 'home', 'Module home', 'yogisolop', '2017-06-04 19:39:22', '::1', 'yogisolop', '2020-05-19 11:06:41', '::1', 1);
INSERT INTO "public"."xi_sa_module" VALUES (2, 'manajemen', 'Manajemen', 'manajemen', 'Module konfigurasi system khusus untuk superadmin', 'yogisolop', '2017-06-04 19:40:50', '::1', 'yogisolop', '2017-08-03 16:00:08', '::1', 1);
INSERT INTO "public"."xi_sa_module" VALUES (3, 'master', 'Data Master', 'master', 'Module data master', 'yogisolop', '2017-11-05 13:58:28', '::1', 'yogisolop', '2020-08-28 23:30:26', '::1', 1);

-- ----------------------------
-- Table structure for xi_sa_rules
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_rules";
CREATE TABLE "public"."xi_sa_rules" (
  "id_rules" int2 NOT NULL DEFAULT nextval('ac_xi_sa_rules'::regclass),
  "id_module" int2 NOT NULL,
  "id_kontrol" int2 NOT NULL,
  "id_fungsi" int2 NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_rules
-- ----------------------------
INSERT INTO "public"."xi_sa_rules" VALUES (1, 1, 1, 1, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (2, 2, 2, 1, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (3, 2, 2, 2, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (4, 2, 2, 3, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (5, 2, 2, 4, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (6, 2, 2, 5, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (7, 2, 2, 7, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (8, 2, 3, 1, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (9, 2, 3, 2, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (10, 2, 3, 3, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (11, 2, 3, 4, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (12, 2, 3, 5, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (13, 2, 3, 7, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (14, 2, 4, 1, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (15, 2, 4, 2, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (16, 2, 4, 3, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (17, 2, 4, 4, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (18, 2, 4, 5, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (19, 2, 4, 7, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (20, 2, 4, 9, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (21, 2, 5, 1, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (22, 2, 5, 2, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (23, 2, 5, 3, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (24, 2, 5, 4, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (25, 2, 5, 5, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (26, 2, 5, 7, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (27, 2, 6, 1, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (28, 2, 6, 2, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (29, 2, 6, 3, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (30, 2, 6, 4, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (31, 2, 6, 5, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (32, 2, 6, 7, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (33, 2, 6, 10, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (34, 2, 7, 1, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (35, 2, 7, 2, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (36, 2, 7, 3, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (37, 2, 7, 4, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (38, 2, 7, 5, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (39, 2, 7, 7, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (40, 2, 7, 8, 1);
INSERT INTO "public"."xi_sa_rules" VALUES (94, 2, 7, 25, 1);

-- ----------------------------
-- Table structure for xi_sa_setting
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_setting";
CREATE TABLE "public"."xi_sa_setting" (
  "id" int4 NOT NULL,
  "app_name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "app_author" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "app_description" text COLLATE "pg_catalog"."default" NOT NULL,
  "app_year" char(4) COLLATE "pg_catalog"."default" NOT NULL,
  "app_icon" varchar(200) COLLATE "pg_catalog"."default" NOT NULL,
  "app_favicon" varchar(200) COLLATE "pg_catalog"."default" NOT NULL,
  "app_keywords" text COLLATE "pg_catalog"."default" NOT NULL,
  "app_versi" char(5) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_setting
-- ----------------------------
INSERT INTO "public"."xi_sa_setting" VALUES (1, 'xxxx', 'Dinas Komunikasi dan Informatika Provinsi Sumatera Barat', 'clear engine', '2022', 'logo_sumbar.png', 'favicon.ico', 'Aplikasi Basic', '1.0.0');

-- ----------------------------
-- Table structure for xi_sa_status
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_status";
CREATE TABLE "public"."xi_sa_status" (
  "id_status" char(2) COLLATE "pg_catalog"."default" NOT NULL,
  "nm_status" varchar(100) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_status
-- ----------------------------
INSERT INTO "public"."xi_sa_status" VALUES ('0 ', 'Tidak Aktif');
INSERT INTO "public"."xi_sa_status" VALUES ('1 ', 'Aktif');

-- ----------------------------
-- Table structure for xi_sa_users
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_users";
CREATE TABLE "public"."xi_sa_users" (
  "id_users" int2 NOT NULL DEFAULT nextval('ac_xi_sa_users'::regclass),
  "token" varchar(32) COLLATE "pg_catalog"."default" NOT NULL,
  "unit_id" int2 NOT NULL,
  "unit_id_name" varchar(255) COLLATE "pg_catalog"."default",
  "username" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "password" varchar(250) COLLATE "pg_catalog"."default" NOT NULL,
  "email" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "fullname" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "foto_profile" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "blokir" int2 NOT NULL,
  "id_status" int2 NOT NULL,
  "validate_email_code" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "validate_email_status" int2 NOT NULL,
  "reset_password_code" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "reset_password_status" int2 NOT NULL,
  "reset_password_expired" int2 NOT NULL,
  "create_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "create_date" timestamp(6) NOT NULL,
  "create_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_by" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "mod_date" timestamp(6) NOT NULL,
  "mod_ip" varchar(20) COLLATE "pg_catalog"."default" NOT NULL
)
;
COMMENT ON COLUMN "public"."xi_sa_users"."foto_profile" IS 'Foto Profile';
COMMENT ON COLUMN "public"."xi_sa_users"."blokir" IS '0=diblokir, 1=tidak diblokir';
COMMENT ON COLUMN "public"."xi_sa_users"."id_status" IS '0=Tidak Aktif, 1=Aktif';

-- ----------------------------
-- Records of xi_sa_users
-- ----------------------------
INSERT INTO "public"."xi_sa_users" VALUES (2, '4A3729CA5A1593D72E67FF0FE31185D1', 0, '', 'primaaulia', '$2a$12$fexNr6W.H7RPvO9rOTjojuHzoWwK1JO7N2nyuFiD/ufsrlO6tU4ju', '', 'Prima Aulia', 'default-user-icon.jpg', 0, 1, '', 0, '', 0, 0, 'yogisolop', '2020-12-23 09:18:01', '::1', 'primaaulia', '2022-01-25 11:18:37', '127.0.0.1');
INSERT INTO "public"."xi_sa_users" VALUES (6, 'C983AC7D398C07B7181CA94D0FBB679F', 0, '', 'superadmin', '$2a$12$C9Zc89G5d6DhEfN.LJMvdO7qa8J2SE6yFj/M9Pix6ANRrHr4E1uo.', '', 'superadmin', 'default-user-icon.jpg', 0, 1, '', 0, '', 0, 0, 'primaaulia', '2023-09-13 16:01:27', '::1', 'primaaulia', '2023-09-13 16:01:27', '::1');

-- ----------------------------
-- Table structure for xi_sa_users_default_pass
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_users_default_pass";
CREATE TABLE "public"."xi_sa_users_default_pass" (
  "id_default_pass" int2 NOT NULL DEFAULT nextval('ac_xi_sa_users_default_pass'::regclass),
  "id_users" int2 NOT NULL,
  "pass_plain" char(100) COLLATE "pg_catalog"."default" NOT NULL,
  "updated" varchar(100) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_users_default_pass
-- ----------------------------
INSERT INTO "public"."xi_sa_users_default_pass" VALUES (3, 5, 'yevikimaisyah@AS123                                                                                 ', 'N');
INSERT INTO "public"."xi_sa_users_default_pass" VALUES (4, 6, 'superadmin123@ASD                                                                                   ', 'N');
INSERT INTO "public"."xi_sa_users_default_pass" VALUES (5, 7, 'superadmin123@ASD                                                                                   ', 'N');
INSERT INTO "public"."xi_sa_users_default_pass" VALUES (6, 8, 'superadmin@123ASD                                                                                   ', 'N');
INSERT INTO "public"."xi_sa_users_default_pass" VALUES (7, 9, 'superadmin@123ASD                                                                                   ', 'N');

-- ----------------------------
-- Table structure for xi_sa_users_privileges
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_users_privileges";
CREATE TABLE "public"."xi_sa_users_privileges" (
  "id_users_privileges" int2 NOT NULL DEFAULT nextval('ac_xi_sa_users_privileges'::regclass),
  "id_users" int2 NOT NULL,
  "id_group" int2 NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_users_privileges
-- ----------------------------
INSERT INTO "public"."xi_sa_users_privileges" VALUES (2, 2, 1, 1);
INSERT INTO "public"."xi_sa_users_privileges" VALUES (89, 2, 3, 0);
INSERT INTO "public"."xi_sa_users_privileges" VALUES (6, 5, 1, 1);
INSERT INTO "public"."xi_sa_users_privileges" VALUES (7, 6, 1, 1);
INSERT INTO "public"."xi_sa_users_privileges" VALUES (8, 7, 1, 1);
INSERT INTO "public"."xi_sa_users_privileges" VALUES (9, 8, 1, 1);
INSERT INTO "public"."xi_sa_users_privileges" VALUES (10, 9, 1, 1);

-- ----------------------------
-- Table structure for xi_sa_white_list
-- ----------------------------
DROP TABLE IF EXISTS "public"."xi_sa_white_list";
CREATE TABLE "public"."xi_sa_white_list" (
  "id_white_list" int2 NOT NULL DEFAULT nextval('ac_xi_sa_white_list'::regclass),
  "module_name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "class_name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "method_name" varchar(100) COLLATE "pg_catalog"."default" NOT NULL,
  "id_status" int2 NOT NULL
)
;

-- ----------------------------
-- Records of xi_sa_white_list
-- ----------------------------
INSERT INTO "public"."xi_sa_white_list" VALUES (1, 'auth', 'signin', 'login', 1);
INSERT INTO "public"."xi_sa_white_list" VALUES (2, 'auth', 'signin', 'logout', 1);
INSERT INTO "public"."xi_sa_white_list" VALUES (3, 'auth', 'signin', 'switch_group', 1);
INSERT INTO "public"."xi_sa_white_list" VALUES (4, 'auth', 'signin', 'timeout', 1);
INSERT INTO "public"."xi_sa_white_list" VALUES (5, 'auth', 'signin', 'account', 1);

-- ----------------------------
-- Function structure for pldbg_abort_target
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_abort_target"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_abort_target"("session" int4)
  RETURNS SETOF "pg_catalog"."bool" AS '$libdir/plugin_debugger', 'pldbg_abort_target'
  LANGUAGE c VOLATILE STRICT
  COST 1
  ROWS 1000;

-- ----------------------------
-- Function structure for pldbg_attach_to_port
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_attach_to_port"("portnumber" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_attach_to_port"("portnumber" int4)
  RETURNS "pg_catalog"."int4" AS '$libdir/plugin_debugger', 'pldbg_attach_to_port'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_continue
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_continue"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_continue"("session" int4)
  RETURNS "public"."breakpoint" AS '$libdir/plugin_debugger', 'pldbg_continue'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_create_listener
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_create_listener"();
CREATE OR REPLACE FUNCTION "public"."pldbg_create_listener"()
  RETURNS "pg_catalog"."int4" AS '$libdir/plugin_debugger', 'pldbg_create_listener'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_deposit_value
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_deposit_value"("session" int4, "varname" text, "linenumber" int4, "value" text);
CREATE OR REPLACE FUNCTION "public"."pldbg_deposit_value"("session" int4, "varname" text, "linenumber" int4, "value" text)
  RETURNS "pg_catalog"."bool" AS '$libdir/plugin_debugger', 'pldbg_deposit_value'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_drop_breakpoint
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_drop_breakpoint"("session" int4, "func" oid, "linenumber" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_drop_breakpoint"("session" int4, "func" oid, "linenumber" int4)
  RETURNS "pg_catalog"."bool" AS '$libdir/plugin_debugger', 'pldbg_drop_breakpoint'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_get_breakpoints
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_get_breakpoints"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_get_breakpoints"("session" int4)
  RETURNS SETOF "public"."breakpoint" AS '$libdir/plugin_debugger', 'pldbg_get_breakpoints'
  LANGUAGE c VOLATILE STRICT
  COST 1
  ROWS 1000;

-- ----------------------------
-- Function structure for pldbg_get_proxy_info
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_get_proxy_info"();
CREATE OR REPLACE FUNCTION "public"."pldbg_get_proxy_info"()
  RETURNS "public"."proxyinfo" AS '$libdir/plugin_debugger', 'pldbg_get_proxy_info'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_get_source
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_get_source"("session" int4, "func" oid);
CREATE OR REPLACE FUNCTION "public"."pldbg_get_source"("session" int4, "func" oid)
  RETURNS "pg_catalog"."text" AS '$libdir/plugin_debugger', 'pldbg_get_source'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_get_stack
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_get_stack"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_get_stack"("session" int4)
  RETURNS SETOF "public"."frame" AS '$libdir/plugin_debugger', 'pldbg_get_stack'
  LANGUAGE c VOLATILE STRICT
  COST 1
  ROWS 1000;

-- ----------------------------
-- Function structure for pldbg_get_target_info
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_get_target_info"("signature" text, "targettype" bpchar);
CREATE OR REPLACE FUNCTION "public"."pldbg_get_target_info"("signature" text, "targettype" bpchar)
  RETURNS "public"."targetinfo"
  LANGUAGE sql VOLATILE
  COST 100

  SELECT p.oid AS target,
         pronamespace AS schema,
         pronargs::int4 AS nargs,
         -- The returned argtypes column is of type oidvector, but unlike
         -- proargtypes, it's supposed to include OUT params. So we
         -- essentially have to return proallargtypes, converted to an
         -- oidvector. There is no oid[] -> oidvector cast, so we have to
         -- do it via text.
         CASE WHEN proallargtypes IS NOT NULL THEN
           translate(proallargtypes::text, ',{}', ' ')::oidvector
         ELSE
           proargtypes
         END AS argtypes,
         proname AS targetname,
         proargmodes AS argmodes,
         proargnames AS proargnames,
         prolang AS targetlang,
         quote_ident(nspname) || '.' || quote_ident(proname) AS fqname,
         proretset AS returnsset,
         prorettype AS returntype,

         't'::bool AS isfunc,
         0::oid AS pkg,
	 NULL::text[] AS argdefvals

  FROM pg_proc p, pg_namespace n
  WHERE p.pronamespace = n.oid
  AND p.oid = $1::oid
  -- We used to support querying by function name or trigger name/oid as well,
  -- but that was never used in the client, so the support for that has been
  -- removed. The targeType argument remains as a legacy of that. You're
  -- expected to pass 'o' as target type, but it doesn't do anything.
  AND $2 = 'o'

;

-- ----------------------------
-- Function structure for pldbg_get_variables
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_get_variables"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_get_variables"("session" int4)
  RETURNS SETOF "public"."var" AS '$libdir/plugin_debugger', 'pldbg_get_variables'
  LANGUAGE c VOLATILE STRICT
  COST 1
  ROWS 1000;

-- ----------------------------
-- Function structure for pldbg_oid_debug
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_oid_debug"("functionoid" oid);
CREATE OR REPLACE FUNCTION "public"."pldbg_oid_debug"("functionoid" oid)
  RETURNS "pg_catalog"."int4" AS '$libdir/plugin_debugger', 'pldbg_oid_debug'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_select_frame
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_select_frame"("session" int4, "frame" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_select_frame"("session" int4, "frame" int4)
  RETURNS "public"."breakpoint" AS '$libdir/plugin_debugger', 'pldbg_select_frame'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_set_breakpoint
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_set_breakpoint"("session" int4, "func" oid, "linenumber" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_set_breakpoint"("session" int4, "func" oid, "linenumber" int4)
  RETURNS "pg_catalog"."bool" AS '$libdir/plugin_debugger', 'pldbg_set_breakpoint'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_set_global_breakpoint
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_set_global_breakpoint"("session" int4, "func" oid, "linenumber" int4, "targetpid" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_set_global_breakpoint"("session" int4, "func" oid, "linenumber" int4, "targetpid" int4)
  RETURNS "pg_catalog"."bool" AS '$libdir/plugin_debugger', 'pldbg_set_global_breakpoint'
  LANGUAGE c VOLATILE
  COST 1;

-- ----------------------------
-- Function structure for pldbg_step_into
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_step_into"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_step_into"("session" int4)
  RETURNS "public"."breakpoint" AS '$libdir/plugin_debugger', 'pldbg_step_into'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_step_over
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_step_over"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_step_over"("session" int4)
  RETURNS "public"."breakpoint" AS '$libdir/plugin_debugger', 'pldbg_step_over'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_wait_for_breakpoint
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_wait_for_breakpoint"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_wait_for_breakpoint"("session" int4)
  RETURNS "public"."breakpoint" AS '$libdir/plugin_debugger', 'pldbg_wait_for_breakpoint'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for pldbg_wait_for_target
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."pldbg_wait_for_target"("session" int4);
CREATE OR REPLACE FUNCTION "public"."pldbg_wait_for_target"("session" int4)
  RETURNS "pg_catalog"."int4" AS '$libdir/plugin_debugger', 'pldbg_wait_for_target'
  LANGUAGE c VOLATILE STRICT
  COST 1;

-- ----------------------------
-- Function structure for plpgsql_oid_debug
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."plpgsql_oid_debug"("functionoid" oid);
CREATE OR REPLACE FUNCTION "public"."plpgsql_oid_debug"("functionoid" oid)
  RETURNS "pg_catalog"."int4"
  LANGUAGE sql VOLATILE STRICT
  COST 100
 SELECT pldbg_oid_debug($1) 
;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_fungsi"
OWNED BY "public"."xi_sa_fungsi"."id_fungsi";
SELECT setval('"public"."ac_xi_sa_fungsi"', 28, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
SELECT setval('"public"."ac_xi_sa_group"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_group_privileges"
OWNED BY "public"."xi_sa_group_privileges"."id_group_privileges";
SELECT setval('"public"."ac_xi_sa_group_privileges"', 281, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_jenis_fungsi"
OWNED BY "public"."xi_sa_jenis_fungsi"."id_jenis_fungsi";
SELECT setval('"public"."ac_xi_sa_jenis_fungsi"', 5, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_kontrol"
OWNED BY "public"."xi_sa_kontrol"."id_kontrol";
SELECT setval('"public"."ac_xi_sa_kontrol"', 8, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_level_akses"
OWNED BY "public"."xi_sa_level_akses"."id_level_akses";
SELECT setval('"public"."ac_xi_sa_level_akses"', 4, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_log_login"
OWNED BY "public"."xi_sa_log_login"."id_log";
SELECT setval('"public"."ac_xi_sa_log_login"', 9, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_log_session"
OWNED BY "public"."xi_sa_log_session"."id_log_session";
SELECT setval('"public"."ac_xi_sa_log_session"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_menu"
OWNED BY "public"."xi_sa_menu"."id_menu";
SELECT setval('"public"."ac_xi_sa_menu"', 14, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_module"
OWNED BY "public"."xi_sa_module"."id_module";
SELECT setval('"public"."ac_xi_sa_module"', 5, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_rules"
OWNED BY "public"."xi_sa_rules"."id_rules";
SELECT setval('"public"."ac_xi_sa_rules"', 95, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_users"
OWNED BY "public"."xi_sa_users"."id_users";
SELECT setval('"public"."ac_xi_sa_users"', 9, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_users_default_pass"
OWNED BY "public"."xi_sa_users_default_pass"."id_default_pass";
SELECT setval('"public"."ac_xi_sa_users_default_pass"', 7, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_users_privileges"
OWNED BY "public"."xi_sa_users_privileges"."id_users_privileges";
SELECT setval('"public"."ac_xi_sa_users_privileges"', 10, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."ac_xi_sa_white_list"
OWNED BY "public"."xi_sa_white_list"."id_white_list";
SELECT setval('"public"."ac_xi_sa_white_list"', 5, false);

-- ----------------------------
-- Primary Key structure for table xi_sa_ci_session
-- ----------------------------
ALTER TABLE "public"."xi_sa_ci_session" ADD CONSTRAINT "xi_sa_ci_session_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table xi_sa_fungsi
-- ----------------------------
ALTER TABLE "public"."xi_sa_fungsi" ADD CONSTRAINT "xi_sa_fungsi_pkey" PRIMARY KEY ("id_fungsi");

-- ----------------------------
-- Primary Key structure for table xi_sa_group
-- ----------------------------
ALTER TABLE "public"."xi_sa_group" ADD CONSTRAINT "xi_sa_group_pkey" PRIMARY KEY ("id_group");

-- ----------------------------
-- Primary Key structure for table xi_sa_group_privileges
-- ----------------------------
ALTER TABLE "public"."xi_sa_group_privileges" ADD CONSTRAINT "xi_sa_group_privileges_pkey" PRIMARY KEY ("id_group_privileges");

-- ----------------------------
-- Primary Key structure for table xi_sa_jenis_fungsi
-- ----------------------------
ALTER TABLE "public"."xi_sa_jenis_fungsi" ADD CONSTRAINT "xi_sa_jenis_fungsi_pkey" PRIMARY KEY ("id_jenis_fungsi");

-- ----------------------------
-- Primary Key structure for table xi_sa_kontrol
-- ----------------------------
ALTER TABLE "public"."xi_sa_kontrol" ADD CONSTRAINT "xi_sa_kontrol_pkey" PRIMARY KEY ("id_kontrol");

-- ----------------------------
-- Primary Key structure for table xi_sa_level_akses
-- ----------------------------
ALTER TABLE "public"."xi_sa_level_akses" ADD CONSTRAINT "xi_sa_level_akses_pkey" PRIMARY KEY ("id_level_akses");

-- ----------------------------
-- Primary Key structure for table xi_sa_log_login
-- ----------------------------
ALTER TABLE "public"."xi_sa_log_login" ADD CONSTRAINT "xi_sa_log_login_pkey" PRIMARY KEY ("id_log");

-- ----------------------------
-- Primary Key structure for table xi_sa_log_session
-- ----------------------------
ALTER TABLE "public"."xi_sa_log_session" ADD CONSTRAINT "xi_sa_log_session_pkey" PRIMARY KEY ("id_log_session");

-- ----------------------------
-- Primary Key structure for table xi_sa_menu
-- ----------------------------
ALTER TABLE "public"."xi_sa_menu" ADD CONSTRAINT "xi_sa_menu_pkey" PRIMARY KEY ("id_menu");

-- ----------------------------
-- Primary Key structure for table xi_sa_module
-- ----------------------------
ALTER TABLE "public"."xi_sa_module" ADD CONSTRAINT "xi_sa_module_pkey" PRIMARY KEY ("id_module");

-- ----------------------------
-- Primary Key structure for table xi_sa_rules
-- ----------------------------
ALTER TABLE "public"."xi_sa_rules" ADD CONSTRAINT "xi_sa_rules_pkey" PRIMARY KEY ("id_rules");

-- ----------------------------
-- Primary Key structure for table xi_sa_setting
-- ----------------------------
ALTER TABLE "public"."xi_sa_setting" ADD CONSTRAINT "xi_sa_setting_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table xi_sa_status
-- ----------------------------
ALTER TABLE "public"."xi_sa_status" ADD CONSTRAINT "xi_sa_status_pkey" PRIMARY KEY ("id_status");

-- ----------------------------
-- Indexes structure for table xi_sa_users
-- ----------------------------
CREATE INDEX "username" ON "public"."xi_sa_users" USING btree (
  "username" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table xi_sa_users
-- ----------------------------
ALTER TABLE "public"."xi_sa_users" ADD CONSTRAINT "xi_sa_users_pkey" PRIMARY KEY ("id_users");

-- ----------------------------
-- Primary Key structure for table xi_sa_users_default_pass
-- ----------------------------
ALTER TABLE "public"."xi_sa_users_default_pass" ADD CONSTRAINT "xi_sa_users_default_pass_pkey" PRIMARY KEY ("id_default_pass");

-- ----------------------------
-- Primary Key structure for table xi_sa_users_privileges
-- ----------------------------
ALTER TABLE "public"."xi_sa_users_privileges" ADD CONSTRAINT "xi_sa_users_privileges_pkey" PRIMARY KEY ("id_users_privileges");

-- ----------------------------
-- Primary Key structure for table xi_sa_white_list
-- ----------------------------
ALTER TABLE "public"."xi_sa_white_list" ADD CONSTRAINT "xi_sa_white_list_pkey" PRIMARY KEY ("id_white_list");

-- ----------------------------
-- Foreign Keys structure for table xi_sa_fungsi
-- ----------------------------
ALTER TABLE "public"."xi_sa_fungsi" ADD CONSTRAINT "fungsiToJenisFungsi" FOREIGN KEY ("id_jenis_fungsi") REFERENCES "public"."xi_sa_jenis_fungsi" ("id_jenis_fungsi") ON DELETE RESTRICT ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table xi_sa_group_privileges
-- ----------------------------
ALTER TABLE "public"."xi_sa_group_privileges" ADD CONSTRAINT "groupPrevilegesToGroup" FOREIGN KEY ("id_group") REFERENCES "public"."xi_sa_group" ("id_group") ON DELETE RESTRICT ON UPDATE CASCADE;
