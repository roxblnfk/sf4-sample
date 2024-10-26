import "@blocknote/core/fonts/inter.css";
import {BlockNoteView} from "@blocknote/mantine";
import "@blocknote/mantine/style.css";
import {useCreateBlockNote} from "@blocknote/react";
import {useEffect, useState} from "react";
import {Block} from "@blocknote/core";
import {loadArticle, saveArticle} from "./Api";
import {ArticleEdit} from "./Dto";

// todo use it
export async function loader() {
    const article: ArticleEdit = await loadArticle('123');
    return {article};
}

export default function Editor() {
    const uuid = '123';
    const [blocks, setBlocks] = useState<Block[]>([]);
    const [title, setTitle] = useState<string>('');

    // Creates a new editor instance
    const editor = useCreateBlockNote({
        trailingBlock: false,
    });

    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string>('');
    useEffect(() => {
        loadArticle('123').then((article) => {
            // Fill the editor with the content of the article
            article.content.length > 0 && editor.replaceBlocks(
                editor.document.map((block) => block.id),
                article.content,
            );
            setTitle(article.title);
            setLoading(false);
        }).catch((error) => {
            setError(error.message);
        });
    }, []);

    return (
        <div>
            {loading
                ? <div>
                    <div>Loading...</div>
                    <div>{error}</div>
                </div>
                : (
                    <div className={"wrapper"}>
                        <button
                            onClick={() => {
                                saveArticle(new ArticleEdit(uuid, title, editor.document))
                            }}
                        > Store
                        </button>
                        <div>BlockNote Editor:</div>
                        <div className={"title"}>
                            <input type="text" placeholder="Title"
                                   value={title}
                                   onChange={(e) => setTitle(e.target.value)}
                            />
                        </div>

                        <div className={"item"}>
                            <BlockNoteView
                                editor={editor}
                                onChange={() => setBlocks(editor.document)}
                            />
                        </div>
                        <div>Document JSON:</div>
                        <div>
                            <button
                                onClick={() => {
                                    const rawContent = document.getElementById('raw-content');
                                    if (rawContent) {
                                        rawContent.style.display = rawContent.style.display === 'none' ? 'block' : 'none';
                                    }
                                }}
                            >Toggle
                            </button>
                        </div>
                        <div className={"item bordered"} id={"raw-content"}>
                <pre>
                  <code>{JSON.stringify(blocks, null, 2)}</code>
                </pre>
                        </div>
                    </div>
                )
            }
        </div>
    );
}
