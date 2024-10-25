import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import {Article} from "./Dto";
import axios from "axios";

export function saveArticle(
    article: Article<string, string, any[]>,
): Promise<Response> {
    return fetch('/api/article/store', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(article)
    });
}

export function loadArticle(
    uuid: string,
): Promise<Article<string, string, any[]>> {
    return axios.get('/api/article/load', {
        params: {
            uuid: uuid,
        },
    }).then((response) => {
        // Map JSON to Article structure
        return {
            uuid: response.data.uuid,
            title: response.data.title,
            content: response.data.content,
        };
    }).catch((error) => {
        return {
            uuid: uuid,
            title: 'empty',
            content: [
                {
                    "id": "442cfe51-640b-496a-9c5a-25e086965b8d",
                    "type": "paragraph",
                    "props": {
                        "textColor": "default",
                        "backgroundColor": "default",
                        "textAlignment": "left"
                    },
                    "content": [
                        {
                            "type": "text",
                            "text": "Hello, world!",
                            "styles": {}
                        }
                    ],
                    "children": []
                }
            ],
        }
    });
}
