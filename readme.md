Aby projekt w pełni działał:
- Przekopiuj pliki
- Upewnij się, że masz zainstalowaną wersję PHP 8.1+
- Uruchom MySQL
- Sprawdź linijkę 28. pliku `.env` <br>
(DATABASE_URL="mysql://użytkownik:hasło@adres:port/baza_danych)
```
DATABASE_URL="mysql://root@127.0.0.1:3306/api
```
- Jeżeli baza danych "api" jeszcze nie istnieje wykonaj polecenie `php bin/console doctrine:database:create`
- Jeżeli baza danych "api" istnieje a nie chesz jej naruszać, zmień `/api` na nową nazwę i wykonaj `php bin/console doctrine:database:create`
- Wykonaj `php bin/console doctrine:migrations:migrate`

Teraz aplikacja powinna działać
- Włącz serwer (Apache)
- Przejdź pod adres `/localhost/`ścieżka_projektu`/public/api/user`
- Strona powinna wyświetlić pustą tablicę (JSON)
- Użyj narzędzia np. `Postman` aby wysłać do  `/localhost/`ścieżka_projektu`/public/api/user/create` request z **raw body** metodą **PUT** np.:
```
{"email":"jan.kowalski@gmail.com", "name":"Jan"}
```
- po dodaniu kilku użytkowników przejdź spowrotem na `/localhost/`ścieżka_projektu`/public/api/user` i sprawdź listę użytkowników