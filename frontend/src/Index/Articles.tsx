import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import React from "react";

class ArticlePreview {
    id: string;
    title: string;
    content: string;

    constructor(id: string, title: string, content: string) {
        this.id = id;
        this.title = title;
        this.content = content;
    }
}

export default function Articles() {

    const [articles, setArticles] = React.useState<ArticlePreview[]>([
        new ArticlePreview('1', 'Article 1', 'This is the content of article 1'),
        new ArticlePreview('2', 'Article 2', 'This is the content of article 2'),
        new ArticlePreview('3', 'Article 3', 'This is the content of article 3'),
        new ArticlePreview('4', 'Article 4', 'This is the content of article 4'),
        new ArticlePreview('5', 'Article 5', 'This is the content of article 5'),
    ]);

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
