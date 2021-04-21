# organigram

## Hierarchy model 

-   **GUEST user**
-   `0` - **guest**
    -   { `void` }
-   `1` **guest follower** (mailing suscribers)
    -   data { `email` }
-   `2` **guest commenter**
    -   data { + `last_ip`, + `last_date` }
    -   grant { + `comment` }
-   **STANDARD user** (writers, gamers, generic user)
    -   data { +`login`, + `passwd` }
-   `3` - **writter**
    -   data { `*` }
    -   grant { + `write` }
-   `4` - **Redactor**
    -   data { `*` }
    -   grant { + `publish` }
-   `5` - 
-   `6` - 
-   **ADMINISTRATOR user**
-   `7` - **webmaster**
    -   data { `*` }
    -   grant { +`ban` +`thems`, +`updates`}
-   `8` - **admin**
    -   data { `*` }
    -   grant { `system (all)`, `user (all)`, `publication (all)` }
-   `9` - **root**
    -   data { `void` }
    -   grant { `all` }
