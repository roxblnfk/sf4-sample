import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import Editor from './Article/Editor';
import Articles from "./Index/Articles";

const root = ReactDOM.createRoot(
  document.getElementById('root') as HTMLElement
);

root.render(
    <React.StrictMode>
        <div className="text-center box-border border-b-2 pb-12">
            <div className="text-5xl font-light mb-4 mt-8"> Header </div>
            {/*<div className="text-xl font-light"> Some words about </div>*/}
            <div className="flex space-x-4 justify-center">
                <div className="inline-block">Home</div>
                <div className="inline-block">Editor</div>
                <div className="inline-block">Login</div>
            </div>
        </div>

        <div className="container mx-auto">
            <Articles></Articles>
        </div>
    </React.StrictMode>
);
