import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import {ArticleEdit, ArticlePreview, ArticleView} from "./Dto";
import axios from "axios";

export function saveArticle(
    article: ArticleEdit,
): Promise<Response> {
    return fetch('/api/article/store', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(article)
    });
}

export async function loadArticlePreviews(): Promise<ArticlePreview[]> {
    return await axios
        .get('/api/articles/list')
        .then((response) => {
            return response.data.articles;
        })
        .catch((error) => {
            return Array.from({length: Math.round(Math.random() * 10) + 5}, (_, i) =>
                new ArticlePreview(`${i + 1}`, `Article ${i + 1}`, `This is the content of article ${i + 1}`));
        });
}

export function loadArticleEdit(
    uuid: string,
): Promise<ArticleEdit> {
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


export function loadArticleView(
    uuid: string,
): Promise<ArticleView> {
    return axios.get('/api/article/load', {
        params: {
            uuid: uuid,
        },
    }).then((response) => {
        // Map JSON to Article structure
        return new ArticleView(response.data.uuid, response.data.title, response.data.content);
    }).catch((error) => {
        return new ArticleView(
            uuid,
            'empty',
            'fooo',
        );
    });
}
