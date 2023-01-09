import ProductIndex from './components/products/index';
import ProductCreate from './components/products/create';
import ProductEdit from './components/products/edit';

export const routes = [
    {
        name: "ProductIndex",
        path: '/product',
        component: ProductIndex,
    },
    {
        name: "ProductCreate",
        path: '/product/create',
        component: ProductCreate,
    },
    {
        name: "ProductEdit",
        path: '/product/edit/:id',
        component: ProductEdit,
    }
];
