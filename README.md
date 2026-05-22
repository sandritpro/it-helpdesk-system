# IT and Information Security Request Tracking System

This version does NOT use SQLite/PDO. Data is stored in JSON files in the `data/` folder, so the `could not find driver` error will no longer occur.

## How to run

1. Unzip the archive.
2. Open CMD/PowerShell in the project folder.
3. Run the command:

```bash
php -S localhost:8000
```

4. Open in your browser:

```
http://localhost:8000
```

## If data is not saved

Make sure the `data` folder is not write-protected.
