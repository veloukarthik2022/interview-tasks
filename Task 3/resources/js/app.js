import {BrowserRouter,Route,Routes} from 'react-router-dom'
import UserEdit from './components/UserEdit';
import Home from './components/Home';
import './bootstrap';
import ReactDOM from 'react-dom';

function App()
{
    return(
        <BrowserRouter>
            <Routes>
                <Route path='/' element={<Home />}></Route>
                <Route path='/user/:id' element={<UserEdit />}></Route>
            </Routes>
        </BrowserRouter>
    );
}

export default App;

if (document.getElementById('example')) {
    ReactDOM.render(<App />, document.getElementById('example'));
}