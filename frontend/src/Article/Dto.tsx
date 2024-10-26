import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import {Block} from "@blocknote/core";

export class ArticleEdit {
    uuid: string;
    title: string;
    content: Block[];

    constructor(uuid: string, title: string, content: Block[]) {
        this.uuid = uuid;
        this.title = title;
        this.content = content;
    }
}

export class ArticlePreview {
    id: string;
    title: string;
    content: string;
    url: string;

    constructor(id: string, title: string, content: string, url?: string) {
        this.id = id;
        this.title = title;
        this.content = content;
        this.url = url || `/article/${id}`;
    }
}

export class ArticleView {
    id: string;
    title: string;
    content: string;

    constructor(id: string, title: string, content: string) {
        this.id = id;
        this.title = title;
        this.content = content;
    }
}
