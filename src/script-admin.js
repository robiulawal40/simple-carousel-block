// import React from 'react';
// import ReactDOM from 'react-dom/client'
// const root = ReactDOM.createRoot(document.getElementById('root'));
// root.render(<React.StrictMode>Hello, world!</React.StrictMode>);

// export const App = () => <div>Just Init</div>;

import ImageIconPlaceholder from "./Inspector/ImageIconPlaceholder";
// require "./Inspector/ImageIconPlaceholder";
function Hello() {
  return <h1>Hello World! It's working <ImageIconPlaceholder></ImageIconPlaceholder></h1>;
}

const container = document.getElementById("root");
const root = ReactDOM.createRoot(container);
root.render(<Hello />);