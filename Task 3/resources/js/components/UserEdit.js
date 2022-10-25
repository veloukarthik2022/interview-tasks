import React, { useEffect } from 'react'
import { useParams, Link } from 'react-router-dom'

export default function UserEdit(props) {
    const { id } = useParams();
    const [userdata, setUserData] = React.useState([]);
    const [name, setName] = React.useState([]);
    const [location, setLocation] = React.useState([]);
    const [address, setAddress] = React.useState([]);
    const [malecheck, setMaleCheck] = React.useState();
    const [femalecheck, setFemaleCheck] = React.useState();
    const [message, setMessage] = React.useState('');

    

    useEffect(() => {

        fetch('/api/users/' + id)
            .then((result) => result.json())
            .then((res) => {
                // console.log(JSON.parse(res.data.name));
                setUserData(res.data);
               
                setName(JSON.parse(res.data.name));
                setLocation(JSON.parse(res.data.location));
                if (res.data.gender == 'Male' || res.data.gender == 'male') {
                    setMaleCheck(true);
                    setFemaleCheck(false);
                }
                else {
                    setMaleCheck(false);
                    setFemaleCheck(true);
                }

            })

    }, [0])

    

    const handleGenderChange = (e) => {
        if (e.target.checked == true) {
            let userData = userdata;

            userData.gender = e.target.value;

            setUserData(userData);
            console.log(userdata);
        }
    }

    const handleChange = (e) => {
        let Name = e.target.name;
        let value = e.target.value;

        let userData = userdata;
        if (Name == 'title' || Name == 'first' || Name == 'last') {
            let nameData = name;

            nameData[Name] = value;
            console.log(nameData, 'existing');
            setName(nameData);

            let userData = userdata;
            userData['name'] = nameData;
            console.log(nameData);
        }

        if (Name == 'street' || Name == 'number') {
            let locationData = location;
            locationData.street[Name] = e.target.value;

            setLocation(locationData);
            console.log(locationData);
            let userData = userdata;
            userData['location'] = locationData;
            setUserData(userData);
        }

        if (Name == 'city' || Name == 'state' || Name == 'country') {
            let locationData = location;
            locationData[Name] = e.target.value;
            setLocation(locationData);
            console.log(locationData);
            let userData = userdata;
            userData['location'] = locationData;
            setUserData(userData);
        }

        if (Name == 'picture') {
            let photo = userData;
            // console.log(photo[Name]);
            photo[Name] = e.target.value;
            console.log(photo)
            setUserData(photo)
        }

        if (Name == 'email' || Name == 'phone') {
            let userData = userdata;
            userData[Name] = e.target.value;

            setUserData(userData);
        }
    }

    const handleSubmit = (e) => {
        e.preventDefault();

        console.log(userdata);

        let data = {
            email:userdata.email,
            gender:userdata.gender,
            name:JSON.stringify(userdata.name),
            location:JSON.stringify(userdata.location),
            phone:userdata.phone,
            picture:userdata.picture
        }

        console.log(data);

        // return;

        fetch("/api/users/" + id,
            {
                method: "put",
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then((res) => res.json())
            .then((result) => {
                console.log(result);
                if (result.status == "success") {
                    setMessage(result.message);
                    setTimeout(() => {
                        setMessage('');
                        window.location.href = "/";
                    },
                        3000)
                }
            })
    }


    if(typeof name == 'string')
    {
        let names = JSON.parse(name);
        // console.log('n1',names);
        setName(names);
    }

    if(typeof location == 'string')
    {
        let locations = JSON.parse(location);
        // console.log('n1',names);
        setLocation(locations);
    }
   

    return (
        <div className='container mt-5'>
            <Link to="/">Back</Link>
            <div className='card'>
                <div className='card-header'>
                    <h4 className='card-title text-center'>User Edit</h4>
                </div>
                <form className='' method='put' onSubmit={(e) => handleSubmit(e)}>
                    <div className='card-body'>


                        <div className='col-sm-12'>
                            <h4>Basic Detail</h4>
                            <div className='row'>
                                <div className='form-group col-sm-12 col-md-4'>
                                    <label>
                                        Title
                                    </label>
                                    <input type='text' required className='form-control' name='title' onChange={(e) => handleChange(e)} defaultValue={name?.title || name['title']}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-4'>
                                    <label>
                                        FirstName
                                    </label>
                                    <input type='text' required className='form-control' name='first' onChange={(e) => handleChange(e)} defaultValue={name?.first}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-4'>
                                    <label>
                                        LastName
                                    </label>
                                    <input type='text' required className='form-control' name='last' onChange={(e) => handleChange(e)} defaultValue={name?.last}></input>
                                </div>
                            </div>
                        </div>
                        <div className='col-sm-12'>
                            <div className='row'>
                                <div className='form-group col-sm-12 col-md-4'>
                                    <label>
                                        Email
                                    </label>
                                    <input type='email' required className='form-control' name='email' onChange={(e) => handleChange(e)} defaultValue={userdata.email}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-4'>
                                    <label>
                                        Phone
                                    </label>
                                    <input type='text' required className='form-control' name='phone' onChange={(e) => handleChange(e)} defaultValue={userdata.phone}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-4'>
                                    <label>
                                        Gender
                                    </label><br />
                                    {/* defaultChecked={userdata.gender=='Male' ? true : false} */}
                                    <input type='radio' name='gender' onChange={(e) => handleGenderChange(e)} defaultChecked={malecheck} value='Male' />Male {' '}
                                    <input type='radio' name='gender' onChange={(e) => handleGenderChange(e)} defaultChecked={femalecheck} value='Female' />Female
                                </div>
                            </div>
                        </div>
                        <div className='col-sm-12 mt-2'>
                            <h4>Location</h4>
                            <div className='row'>
                                <div className='form-group col-sm-12 col-md-2'>
                                    <label>
                                        House No.
                                    </label>
                                    <input type='text' required className='form-control' name='number' onChange={(e) => handleChange(e)} defaultValue={location.street?.number}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-2'>
                                    <label>
                                        Street
                                    </label>
                                    <input type='text' required className='form-control' name='street' onChange={(e) => handleChange(e)} defaultValue={location.street?.name}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-2'>
                                    <label>
                                        City
                                    </label>
                                    <input type='text' required className='form-control' name='city' onChange={(e) => handleChange(e)} defaultValue={location.city}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-3' >
                                    <label>
                                        State
                                    </label>
                                    <input type='text' required className='form-control' name='state' onChange={(e) => handleChange(e)} defaultValue={location.state}></input>
                                </div>
                                <div className='form-group col-sm-12 col-md-3' >
                                    <label>
                                        Country
                                    </label>
                                    <input type='text' required className='form-control' name='country' onChange={(e) => handleChange(e)} defaultValue={location.country}></input>
                                </div>
                            </div>
                        </div>
                        <div className='col-sm-12'>
                            <div className='row'>
                                <div className='form-group col-sm-12 col-md-4'>
                                    <label>
                                        Profile
                                    </label>
                                    <input type='text' required className='form-control' name='picture' onChange={(e) => handleChange(e)} defaultValue={userdata.picture}></input>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div className='card-footer'>
                        <input type='submit' className='btn btn-success' value='Submit'></input>
                        {message ? <div className='alert alert-success'>{message}</div> : ""}
                    </div>
                </form>
            </div>



        </div>
    )
}


