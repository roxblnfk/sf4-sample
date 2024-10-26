import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import React from "react";
import {ArticlePreview, ArticleView} from "./Dto";
import {useLoaderData} from "react-router-dom";
import {loadArticleView} from "./Api";

export async function loader() {
    const article = await loadArticleView('123');
    return {article};
}

/*
 * Article page component
 */
export default function Article() {
    const {article} = useLoaderData() as { article: ArticleView };

    return (
        <div className="max-w-3xl mx-auto">
            <h1 className="text-2xl text-center p-5">{article.title}</h1>
            <div>
                {article.content}
            </div>
        </div>
    );
}
