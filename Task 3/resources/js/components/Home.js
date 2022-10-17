import React, { Component } from 'react'
import Table from 'react-bootstrap/Table';
import { Link } from 'react-router-dom'

export default class Home extends Component {

    constructor(props) {
        super(props);

        this.state = {
            userList: [],
            limit: 5,
        }
    }

    componentDidMount() {
        this.apiCall(this.state.limit);
    }

    apiCall(limit = '') {

        fetch("/api/users?limit=" + limit)
            .then((result) => result.json())
            .then((res) => {
                console.log(res.data.total);
                this.setState({ userList: res.data.data });
                this.setState({ total: res.data.total });
            })
    }

    nameSpace(title, first) {
        return title + ' ' + first;
    }

    pagination() {
        if (this.state.total >= this.state.limit) {
            let limit = this.state.limit + 5;
            this.setState({ limit: limit })
            this.apiCall(limit)
        }
        else {
            this.setState({ lmessage: "All data loaded successfully" })
            setTimeout(() => {
                this.setState({ lmessage: '' });

            }, 3000)
        }


    }

    handleEdit(val) {
        console.log(val);
    }

    handleDelete(id) {
        fetch("/api/users/" + id, {
            method: "delete"
        })
            .then((res) => res.json())
            .then((result) => {
                console.log(result.status);
                if (result.status) {
                    this.setState({ message: result.message });
                    this.apiCall();
                    setTimeout(() => {
                        this.setState({ message: '' });

                    }, 3000)
                }
                else {
                    this.setState({ emessage: result.message });
                    setTimeout(() => {
                        this.setState({ emessage: '' });
                    }, 3000)
                }
            })
    }

    storeData()
    {
        fetch("/api/users",{
            headers:{
                "content-type":"application/json"
            },
            method:"post"
        })
        .then((res)=>res.json())
        .then((result)=>{
            console.log(result);
        })
        .catch((e)=>{
            console.log(e);
        })
    }

    render() {
        return (
            <div className='container m-5'>
                <div>
                    {this.state.message ? <div className='mt-2 alert alert-success'>{this.state.message}</div> : ""}
                    {this.state.emessage ? <div className='mt-2 alert alert-success'>{this.state.emessage}</div> : ""}
                </div>
                <div className='col-sm-12 mb-3 text-right'>
                    <div className='row'>
                        <div className='col-sm-12 col-lg-2'>
                            <a href='/api/users/export' className='btn btn-primary'>Export CSV</a>
                        </div>
                        <div className='col-sm-12 col-lg-2 text-right'>
                            <button type='button' onClick={()=>this.storeData()} className='btn btn-primary'>Import Data</button>
                        </div>

                    </div>


                </div>
                <div className='card'>
                    <div className='card-header'>
                        <h4 className='card-title'>List of Users</h4>
                    </div>
                    <div className='card-body'>
                        <Table responsive="sm" striped bordered hover>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {this.state.userList && this.state.userList.map((val, i) => {
                                    // console.log(val.name['first']);
                                    let name = JSON.parse(val.name);
                                    return (
                                        <tr key={i}>
                                            <td>{val.id}</td>
                                            <td>{this.nameSpace(name.title, name.first)}</td>
                                            <td>{name.last}</td>
                                            <td>{val.email}</td>
                                            <td>
                                                <Link className='text-primary' to={"user/" + val.id}><i className="bi bi-pencil"></i></Link>{' '}
                                                <i onClick={() => this.handleDelete(val.id)} className="text-danger bi bi-trash"></i></td>
                                        </tr>
                                    );
                                })}


                            </tbody>
                        </Table>
                    </div>
                    <div className='card-footer'>
                        <button className='btn btn-primary' onClick={() => this.pagination()}>Load more</button>
                        {this.state.lmessage ? <div className='mt-2 alert alert-danger'>{this.state.lmessage}</div> : ""}
                    </div>
                </div>


            </div>
        )
    }
}
