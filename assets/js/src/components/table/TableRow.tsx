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
                    <img src="http://www.skytech.lt/images/small/41/1541341.jpg" alt="Image" />
                </td>
                <td><a href={product.url}>{product.name}</a></td>
                <td>{product.price}</td>
                <td>{product.shop}</td>
            </tr>
        );
    }
}