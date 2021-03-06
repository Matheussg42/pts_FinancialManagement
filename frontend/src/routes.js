import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom';

import Logon from './pages/Logon';
import Register from './pages/Register';
import Financas from './pages/Financas';
import Ano from './pages/Ano';
import Historico from './pages/Historico';

export default function Routes() {
  return (
    <BrowserRouter>
      <Switch>
        <Route path="/" exact component={Logon} />
        <Route path="/register" component={Register} />

        <Route path="/financas" component={Financas} />
        <Route path="/ano" component={Ano} />
        <Route path="/historico" component={Historico} />
      </Switch>
    </BrowserRouter>
  );
}