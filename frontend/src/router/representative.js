export default {
  path: "/representatives",
  name: "representatives",
  component: () => import("../components/representative/Layout"),
  redirect: { name: "RepresentativeList" },
  children: [
    {
      name: "RepresentativeList",
      path: "",
      component: () => import("../views/representative/List"),
    },
    {
      name: "RepresentativeCreate",
      path: "new",
      component: () => import("../views/representative/Create"),
    },
    {
      name: "RepresentativeUpdate",
      path: ":id/edit",
      component: () => import("../views/representative/Update"),
    },
    {
      name: "RepresentativeShow",
      path: ":id",
      component: () => import("../views/representative/Show"),
    },
  ],
};
