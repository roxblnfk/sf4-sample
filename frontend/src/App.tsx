import "@blocknote/core/fonts/inter.css";
import { BlockNoteView } from "@blocknote/mantine";
import "@blocknote/mantine/style.css";
import { useCreateBlockNote } from "@blocknote/react";
import {useState} from "react";
import {Block} from "@blocknote/core";

export default function App() {
    // Stores the document JSON.
    const [blocks, setBlocks] = useState<Block[]>([]);

    // Creates a new editor instance.
    const editor = useCreateBlockNote({
        // initialContent: [],
        trailingBlock: false,
    });

    // Renders the editor instance using a React component.
    return (
        <div className={"wrapper"}>
            <div>BlockNote Editor:</div>
            <div className={"item"}>
                <BlockNoteView
                    editor={editor}
                    onChange={() => {
                        // Saves the document JSON to state.
                        setBlocks(editor.document);
                    }}
                />
            </div>
            <div>Document JSON:</div>
            <div className={"item bordered"}>
        <pre>
          <code>{JSON.stringify(blocks, null, 2)}</code>
        </pre>
            </div>
        </div>
    );
}
