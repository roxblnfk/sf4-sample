import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import React from "react";
import {ArticlePreview} from "./Dto";
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
    const {article} = useLoaderData() as { article: ArticlePreview };

    return (
        <div>
            <h1 className="text-2xl text-center p-5">{article.title}</h1>
            <div className="container mx-auto">
                {article.content}
            </div>
        </div>
    );
}
