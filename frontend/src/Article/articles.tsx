import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import React from "react";
import {ArticlePreview} from "./Dto";
import {useLoaderData} from "react-router-dom";
import {loadArticles} from "./Api";

export async function loader() {
    const articles = await loadArticles();
    return {articles};
}

export default function Articles() {
    const {articles} = useLoaderData() as { articles: ArticlePreview[] };

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
