import "@blocknote/core/fonts/inter.css";
import "@blocknote/mantine/style.css";
import {Block} from "@blocknote/core";

export type Article<
    uuid extends string,
    title extends string,
    content extends Block[],
> = {
    uuid: uuid,
    title: title,
    content: content,
}
