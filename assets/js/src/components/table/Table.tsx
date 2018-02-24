import * as React from "react";
import {Product} from "../../App";
import TableRow from "./TableRow";

export interface Props {
    products: Product[];
    onPricePress(sort: boolean): void;
    sortDescending: boolean;
}

export interface States {
    //sortDescending: boolean;
}

export default class Table extends React.Component<Props, States> {
    constructor(props: Props) {
        super(props);

        /*this.state = {
            sortDescending: false
        };*/
    }

    private handleOnPriceClick() {
        this.props.onPricePress(!this.props.sortDescending);
    }

    public render() {
        const products = this.props.products;

        return (
            <div>
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>
                                <a href="#" onClick={() => this.handleOnPriceClick()}>Price</a>
                                {this.props.sortDescending ? 'UP' : 'DOWN'}
                            </th>
                            <th>Shop</th>
                        </tr>
                    </thead>
                    <tbody>
                    {products.map((product, index) => {
                        return <TableRow product={product} key={index}/>
                    })}
                    </tbody>
                </table>
            </div>
        );
    }
}