<?php

echo '
{
    "attachments": [
        {
            "title": "Commands for Question Logger:",
            "fields": [
                {
                    "value": "Commands are written like this: /q [command] :: [variable] \n The :: symbols are used as spacers between variables",
                    "short": false
                },
                {
                    "title": "Commands",
                    "value": "/q add \n Adds a question",
                    "short": true
                },
                {
                    "title": "Variables",
                    "value": ":: [question] :: [type (optional)] \n Types: teacher, group, all",
                    "short": true
                },
                {
                    "value": "/q list \n Lists all questions",
                    "short": true
                },
                {
                    "value": ":: [filter (optional)] \n Filters: type teacher, type group, type all, questions, answers, all",
                    "short": true
                },
                {
                    "value": "/q answer \n Adds an answer to a question",
                    "short": true
                },
                {
                    "value": ":: [answer] :: [id]",
                    "short": true
                },
                {
                    "value": "/q remove \n Removes a specified question",
                    "short": true
                },
                {
                    "value": ":: [id]",
                    "short": true
                }
            ]
        }
    ]
}
';

?>