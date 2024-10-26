import React from 'react';
import Articles, {loader as articlesLoader} from "../Article/articles";
import {createBrowserRouter, Link, Outlet, RouterProvider} from "react-router-dom";
import ErrorPage from "../error-page";
import Contact from "../Profile/contact";
import Editor, {loader as editorLoader} from "../Article/editor";
import Article, {loader as articleViewLoader} from "../Article/view";

const router = createBrowserRouter([
    {
        path: "/",
        element: <Template/>,
        errorElement: <ErrorPage/>,
        children: [
            {
                path: "",
                element: <Articles/>,
                loader: articlesLoader,
            },
            {
                path: "article/",
                children: [
                    {
                        path: "view/:articleId",
                        element: <Article/>,
                        loader: articleViewLoader,
                    },
                    {
                        path: "edit/:articleId",
                        element: <Editor/>,
                        loader: editorLoader,
                    }
                ],
            },
            {
                path: "contacts/:contactId",
                element: <Contact/>,
            },
        ]
    },
]);

export default function Index() {
    return (
        <React.StrictMode>
            <RouterProvider router={router}/>
        </React.StrictMode>
    );
}

export function Template() {
    return (
        <React.StrictMode>
            <div className="text-center box-border border-b-2 pb-12">
                <div className="text-5xl font-light mb-4 mt-8"> Header</div>
                <div className="flex space-x-4 justify-center">
                    <div className="inline-block">
                        <Link to={`/`}>Home</Link>
                    </div>
                </div>
                {/*<div>*/}
                {/*    <form id="search-form" role="search">*/}
                {/*        <input*/}
                {/*            id="q"*/}
                {/*            aria-label="Search contacts"*/}
                {/*            placeholder="Search"*/}
                {/*            type="search"*/}
                {/*            name="q"*/}
                {/*        />*/}
                {/*        <div*/}
                {/*            id="search-spinner"*/}
                {/*            aria-hidden*/}
                {/*            hidden={true}*/}
                {/*        />*/}
                {/*        <div*/}
                {/*            className="sr-only"*/}
                {/*            aria-live="polite"*/}
                {/*        ></div>*/}
                {/*    </form>*/}
                {/*    <form method="post">*/}
                {/*        <button type="submit">New</button>*/}
                {/*    </form>*/}
                {/*</div>*/}
            </div>

            <div className="container mx-auto" id="detail">
                <Outlet/>
            </div>
        </React.StrictMode>
    );
}
