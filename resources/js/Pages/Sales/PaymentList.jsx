import { Head, usePage} from "@inertiajs/react";
import AppLayout from "../Layouts/AppLayouts";
import PageHeader from "../Component/PageHeader";
import DeleteBtn from "../Component/DeleteBtn";

function PaymentList({ payments }) {
    console.log(payments)
    const {setting} = usePage().props
    return (
        <AppLayout>
            <Head>
                <title>Payment List - Dashboard</title>
            </Head>

            <PageHeader title="Payments" subtitle="Manage Payment">
            </PageHeader>

            <div className="card">
                <div className="card-body">
                    <div className="table-responsive">
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Sale ID</th>
                                    <th>Amount({setting.currency_symbol})</th>
                                    <th>Method</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    payments.data.map((item,index) => {
                                        return (
                                            <tr key={index}>
                                                <td>{item.date}</td>
                                                <td>{item.sale_id}</td>
                                                <td>{item.amount}</td>
                                                <td>{item.payment_method}</td>
                                                <td>
                                                    <DeleteBtn routeName={"sales.payment.destroy"} resource={item.id}/>
                                                </td>
                                            </tr>
                                        )
                                    })
                                }                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}


export default PaymentList;
