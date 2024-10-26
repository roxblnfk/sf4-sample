import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import React from "react";
import {ArticlePreview} from "./Dto";
import {Link, useLoaderData} from "react-router-dom";
import {loadArticlePreviews} from "./Api";

export async function loader() {
    const articles = await loadArticlePreviews();
    return {articles};
}

export default function Articles() {
    const {articles} = useLoaderData() as { articles: ArticlePreview[] };

    return (
        <div className="pt-2">
            <h1 className="text-2xl text-center p-5">Articles</h1>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-16">
                {articles.map((article: ArticlePreview) => (
                    <div key={article.id} className="border-2">
                        <Link to={`/article/view/${article.id}`}>
                            <div className="h-32 bg-blue-800"></div>
                            <h2 className="text-xl m-4">{article.title}</h2>
                        </Link>
                        <div className="mt-4 mx-4">
                            {article.content}
                        </div>
                        <div className="flex flex-nowrap items-center justify-items-stretch">
                            <div className="text-gray-600 text-nowrap m-4">⭐ 123</div>
                            <div className="text-gray-600 text-nowrap m-4">🗨️ 42</div>
                            <div className="text-gray-600 text-nowrap m-4">👁️ 42k</div>
                            <Link to={`/article/edit/${article.id}`} className="justify-self-end">
                                <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                                    ✏️
                                </button>
                            </Link>
                        </div>
                    </div>
                ))}
                </div>
        </div>
    );
}
