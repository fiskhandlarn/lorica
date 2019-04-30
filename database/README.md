Use [export_local.sh](./export_local.sh) to export current database to SQL file (with filename set from `DB_NAME` in `.env`). All occurrences of the site url (as defined by `BROWSER_SYNC_HOST` in `.env`) is replaced with `ROOTURL`. This also runs [cleanup.sql](./cleanup.sql) on current database.

Use [import_local.sh](./import_local.sh) to replace current database with the contents from SQL file (with filename set from `DB_NAME` in `.env`). All occurrences of `ROOTURL` in the SQL file is replaced with the site url (as defined by `BROWSER_SYNC_HOST` in `.env`).

Rename and edit [migrate_domain.tld.sh](./migrate_domain.tld.sh) and use that to migrate current database to SQL file suitable for remote deployment.

## Docker

Use these commands if your database is within Docker:

```bash
$ docker-compose run wpcli /lorica/database/export_local.sh
$ docker-compose run wpcli /lorica/database/import_local.sh
$ docker-compose run wpcli /lorica/database/migrate_domain.tld.sh
```
