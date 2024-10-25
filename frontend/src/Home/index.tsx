import React from 'react';
import Articles from "./articles";
import {createBrowserRouter, Link, Outlet, RouterProvider} from "react-router-dom";
import ErrorPage from "../error-page";
import Contact from "../Profile/contact";

const router = createBrowserRouter([
    {
        path: "/",
        element: <Home/>,
        errorElement: <ErrorPage/>,
        children: [
            {
                path: "",
                element: <Articles/>,
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

export function Home() {
    return (
        <React.StrictMode>
            <div className="text-center box-border border-b-2 pb-12">
                <div className="text-5xl font-light mb-4 mt-8"> Header</div>
                <div className="flex space-x-4 justify-center">
                    <div className="inline-block">
                        <Link to={`/`}>Home</Link>
                    </div>
                    <div className="inline-block">
                        <Link to={`/contacts/1`}>Your Name</Link>
                    </div>
                    <div className="inline-block">
                        <Link to={`/contacts/2`}>Your Friend</Link>
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
