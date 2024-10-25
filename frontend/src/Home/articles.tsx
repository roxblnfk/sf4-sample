import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import React, {useEffect} from "react";
import axios from "axios";

class ArticlePreview {
    id: string;
    title: string;
    content: string;
    url: string;

    constructor(id: string, title: string, content: string, url?: string) {
        this.id = id;
        this.title = title;
        this.content = content;
        this.url = url || `/article/${id}`;
    }
}

export default function Articles() {

    const [articles, setArticles] = React.useState<ArticlePreview[]>([]);

    useEffect(() => {
        axios.get('/api/article/load', {
            params: {
                uuid: '123',
            },
        }).then((response) => {
            // Map JSON to Article structure
            return {
                uuid: response.data.uuid,
                title: response.data.title,
                content: response.data.content,
            };
        }).catch((error) => {
            setArticles(Array.from({length: Math.round(Math.random() * 10) + 5}, (_, i) =>
                new ArticlePreview(`${i + 1}`, `Article ${i + 1}`, `This is the content of article ${i + 1}`)));
        });
    }, []);

    return (
        <div className="pt-2">
            <h1 className="text-2xl text-center p-5">Articles</h1>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-16">
                {articles.map((article: ArticlePreview) => (
                    <div key={article.id} className="border-2 p-2">
                        <h2 className="text-xl">{article.title}</h2>
                        <p>{article.content}</p>
                    </div>
                ))}
            </div>
        </div>
    );
}
