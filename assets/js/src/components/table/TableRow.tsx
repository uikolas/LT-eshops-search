import * as React from "react";
import {Product} from "../../App";

export interface Props {
    product: Product;
}

export default class TableRow extends React.Component<Props, {}> {
    public render() {
        const product = this.props.product;

        return (
            <tr>
                <td>
                    <img src={product.image} alt="Image" />
                </td>
                <td><a href={product.url} target="_blank">{product.name}</a></td>
                <td><strong>{product.price}</strong></td>
                <td>{product.shop}</td>
            </tr>
        );
    }
}