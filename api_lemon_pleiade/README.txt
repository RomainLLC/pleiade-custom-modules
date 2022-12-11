API Pléiade pour SSO avec LemonLDAP

// TODO : doc ! + passer le README en .md

// TODO : indiquer qu'il faut le mod php-curl (phpenmod curl)

exemple d'une requête curl Lemon / Myapplications :

curl 'https://authdev.ecollectivites.fr/myapplications' -H 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0' -H 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8' -H 'Accept-Language: fr,fr-FR;q=0.8,en-US;q=0.5,en;q=0.3' -H 'Accept-Encoding: gzip, deflate, br' -H 'DNT: 1' -H 'Connection: keep-alive' -H 'Cookie: llnglanguage=fr; lemonldap=076e890b80eb23483d352541795b70751f86c57cba94c2a0a20466d55ec4ae53' -H 'Upgrade-Insecure-Requests: 1' -H 'Sec-Fetch-Dest: document' -H 'Sec-Fetch-Mode: navigate' -H 'Sec-Fetch-Site: none' -H 'Sec-Fetch-User: ?1' -H 'Pragma: no-cache' -H 'Cache-Control: no-cache'


## Admin

/admin/config/api_lemon_pleiade/settings