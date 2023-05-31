const React = require('react');
const ReactDOM = require('react-dom');
const App = require('./App');

ReactDOM.render(
  App.default ? <App.default /> : <App />,
  document.getElementById('root')
);